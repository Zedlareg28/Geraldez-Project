<?php

namespace App\Controllers;

use App\Models\LeaveModel;

class LeaveController extends BaseController
{
    protected $leaveModel;
    protected $helpers = ['form', 'url'];

    public function __construct()
    {
        $this->leaveModel = new LeaveModel();
    }

    // Staff: list own leaves
    public function index()
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('user_id');
        $data['leaves'] = $this->leaveModel->where('user_id', $userId)->orderBy('start_date','DESC')->findAll();

        return view('leaves/index', $data);
    }

    // Staff: show create form
    public function create()
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        return view('leaves/create');
    }

    // Staff: store leave request
    public function store()
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $rules = [
            'start_date' => 'required|valid_date[Y-m-d]',
            'end_date'   => 'required|valid_date[Y-m-d]',
            'type'       => 'required',
            'reason'     => 'required|min_length[3]'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->leaveModel->save([
            'user_id'    => session()->get('user_id'),
            'start_date' => $this->request->getPost('start_date'),
            'end_date'   => $this->request->getPost('end_date'),
            'type'       => $this->request->getPost('type'),
            'reason'     => $this->request->getPost('reason'),
            'status'     => 'pending'
        ]);

        return redirect()->to('/leaves')->with('message', 'Leave request submitted.');
    }

    // Admin: view all leave requests
    public function adminIndex()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $data['leaves'] = $this->leaveModel->orderBy('created_at','DESC')->findAll();
        return view('leaves/admin_index', $data);
    }

    // Admin: approve
    public function approve($id = null)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }
        $this->leaveModel->update($id, ['status' => 'approved']);
        return redirect()->back()->with('message','Leave approved.');
    }

    // Admin: reject
    public function reject($id = null)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }
        $this->leaveModel->update($id, ['status' => 'rejected']);
        return redirect()->back()->with('message','Leave rejected.');
    }
}