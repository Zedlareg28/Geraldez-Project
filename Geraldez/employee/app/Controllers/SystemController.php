<?php
namespace App\Controllers;

use App\Models\SystemStatusModel;
use CodeIgniter\Controller;
use App\Models\UserActivityModel;

class SystemController extends Controller
{
    protected $helpers = ['form', 'url', 'activity'];

    public function index()
    {
        $model = new SystemStatusModel();
        $data['status'] = $model->first()['status'];

        return view('dashboard/admin', $data);
    }

    public function toggle()
    {
        $model = new SystemStatusModel();
        $status = $model->first();

        $newStatus = ($status['status'] === 'online') ? 'maintenance' : 'online';
        $model->update($status['id'], ['status' => $newStatus]);

        log_activity('System mode changed to ' . $newStatus);

        return redirect()->to('/admin/system')->with('message', 'System mode updated successfully!');
    }
}
