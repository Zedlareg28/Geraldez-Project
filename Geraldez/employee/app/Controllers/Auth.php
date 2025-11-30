<?php
namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        helper(['form', 'url', 'activity']);
    }

    // STAFF LOGIN PAGE
    public function login()
    {
        return view('auth/login_staff');
    }

    // STAFF LOGIN PROCESS
    public function loginProcess()
{
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    $user = $this->userModel
        ->where('username', $username)
        ->where('role', 'staff')
        ->first();

    if ($user) {
        $status = $user['status'] ?? 'active';
        if ($status === 'blocked') {
            log_activity("Blocked login attempt for blocked user: {$username}");
            return redirect()->back()->with('error', 'Account is blocked. Contact admin.');
        }

        if (password_verify($password, $user['password'])) {
            session()->set([
                'user_id'  => $user['id'],
                'username' => $user['username'],
                'role'     => 'staff',
                'logged_in'=> true
            ]);

            // Log activity with MAC
            log_activity("Staff logged in: {$username}");

            return redirect()->to('/dashboard/staff');
        }
    }

    return redirect()->back()->with('error', 'Invalid staff credentials.');
}

    // ADMIN LOGIN PAGE
    public function adminLogin()
    {
        return view('auth/login_admin');
    }

    // ADMIN LOGIN PROCESS
    public function adminLoginProcess()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $this->userModel
            ->where('username', $username)
            ->where('role', 'admin')
            ->first();

        if ($user) {
            $status = $user['status'] ?? 'active';
            if ($status === 'blocked') {
                log_activity("Blocked admin login attempt: {$username}");
                return redirect()->back()->with('error', 'Account is blocked.');
            }

            if (password_verify($password, $user['password'])) {
                session()->set([
                    'user_id'  => $user['id'],
                    'username' => $user['username'],
                    'role'     => 'admin',
                    'logged_in'=> true
                ]);

                log_activity("Admin logged in: $username");
                return redirect()->to('/dashboard/admin');
            }
        }

        return redirect()->back()->with('error', 'Invalid admin credentials.');
    }

    // LOGOUT
    public function logout()
    {
        log_activity("User logged out: " . session()->get('username'));
        session()->destroy();
        return redirect()->to('/login');
    }

    // REGISTER PAGE
    public function register()
    {
        return view('auth/register');
    }

    // REGISTER PROCESS
    public function registerProcess()
    {
        $post = $this->request->getPost();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'fullname'         => 'required|min_length[3]',
            'username'         => 'required|alpha_numeric|min_length[3]|is_unique[users.username]',
            'password'         => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]',
            'role'             => 'required|in_list[admin,staff]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        try {
            $this->userModel->insert([
                'fullname' => $post['fullname'],
                'username' => $post['username'],
                'password' => password_hash($post['password'], PASSWORD_DEFAULT),
                'role'     => $post['role'],
                'status'   => 'active',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Registration failed: ' . $e->getMessage());
        }

        log_activity("New user registered: " . $post['username']);
        return redirect()->to('/login')->with('success', 'Registration successful! You can now login.');
    }

}
