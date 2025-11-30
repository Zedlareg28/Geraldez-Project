<?php
namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        helper(['url', 'activity']);
    }

    protected function adminOnly()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }
        return null;
    }

    // Admin: block a user by username
    public function blockUser($username = null)
    {
        if ($resp = $this->adminOnly()) return $resp;
        if (! $username) return redirect()->back()->with('error', 'Invalid user.');

        $user = $this->userModel->where('username', $username)->first();
        if (! $user) return redirect()->back()->with('error', 'User not found.');

        if (isset($user['status']) && $user['status'] === 'blocked') {
            return redirect()->back()->with('message', 'User already blocked.');
        }

        $this->userModel->update($user['id'], ['status' => 'blocked']);
        log_activity("Admin " . session()->get('username') . " blocked user: {$username}");

        return redirect()->back()->with('message', 'User blocked.');
    }

    // Admin: unblock user
    public function unblockUser($username = null)
    {
        if ($resp = $this->adminOnly()) return $resp;
        if (! $username) return redirect()->back()->with('error', 'Invalid user.');

        $user = $this->userModel->where('username', $username)->first();
        if (! $user) return redirect()->back()->with('error', 'User not found.');

        $this->userModel->update($user['id'], ['status' => 'active']);
        log_activity("Admin " . session()->get('username') . " unblocked user: {$username}");

        return redirect()->back()->with('message', 'User unblocked.');
    }
}