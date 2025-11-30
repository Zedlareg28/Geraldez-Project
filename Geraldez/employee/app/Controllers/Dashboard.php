<?php
namespace App\Controllers;

use App\Models\SystemStatusModel;

class Dashboard extends BaseController
{
    public function admin()
    {
        if (session()->get('role') !== 'admin') return redirect()->to('/login');

        $status = (new SystemStatusModel())->first()['status'] ?? 'online';
        return view('dashboard/admin', ['status' => $status]);
    }

    public function staff()
    {
        if (session()->get('role') !== 'staff') return redirect()->to('/login');

        $status = (new SystemStatusModel())->first()['status'] ?? 'online';
        return view('dashboard/staff', ['status' => $status]);
    }
}
