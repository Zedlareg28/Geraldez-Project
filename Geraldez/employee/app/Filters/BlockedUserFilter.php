<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\UserModel;

class BlockedUserFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // don't run in CLI
        if (PHP_SAPI === 'cli') {
            return;
        }

        $session = session();
        $userId  = $session->get('user_id');

        // nothing to check for guests
        if (! $userId) {
            return;
        }

        $userModel = new UserModel();
        $user = $userModel->find($userId);

        if (! $user) {
            // if session user id is stale, destroy session
            $session->destroy();
            return;
        }

        // if admin keep access; otherwise if blocked, log out and redirect to login
        if (isset($user['status']) && $user['status'] === 'blocked') {
            // destroy session immediately so they can't continue
            $session->destroy();

            // redirect to login with an error message
            return redirect()->to(site_url('/login'))->with('error', 'Your account has been blocked. Contact administrator.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // no-op
    }
}