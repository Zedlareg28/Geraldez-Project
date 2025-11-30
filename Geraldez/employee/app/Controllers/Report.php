<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\LeaveModel;

class Report extends BaseController
{
    protected $helpers = ['form', 'url']; // <-- load form helper for set_value()

    public function index()
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $status   = $this->request->getGet('status');
        $position = $this->request->getGet('position');

        $model = new EmployeeModel();

        if ($status) {
            $model = $model->where('status', $status);
        }
        if ($position) {
            $model = $model->like('position', $position);
        }

        $data['employees'] = $model->orderBy('fullname','ASC')->findAll();

        // pass current filter values to the view (avoid using $this->request in the view)
        $data['selectedStatus'] = $status;
        $data['positionFilter'] = $position;

        return view('reports/index', $data);
    }

    public function exportCsv()
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $status   = $this->request->getGet('status');
        $position = $this->request->getGet('position');

        $model = new EmployeeModel();

        if ($status) {
            $model = $model->where('status', $status);
        }
        if ($position) {
            $model = $model->like('position', $position);
        }

        $employees = $model->orderBy('fullname','ASC')->findAll();

        $filename = 'employees_report_'.date('Ymd_His').'.csv';
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="'.$filename.'"');

        $out = fopen('php://output', 'w');
        fputcsv($out, ['Employee ID','Fullname','Position','Salary','Phone','Email','Status']);
        foreach ($employees as $e) {
            fputcsv($out, [
                $e['employee_id'] ?? '',
                $e['fullname'] ?? '',
                $e['position'] ?? '',
                $e['salary'] ?? '',
                $e['phone'] ?? '',
                $e['email'] ?? '',
                $e['status'] ?? ''
            ]);
        }
        fclose($out);
        exit;
    }

    public function leaves()
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $status = $this->request->getGet('status');
        $userId = $this->request->getGet('user_id');

        $model = new LeaveModel();

        // staff see only their own leaves; admin can filter by user_id
        if (session()->get('role') !== 'admin') {
            $model = $model->where('user_id', session()->get('user_id'));
        } elseif ($userId) {
            $model = $model->where('user_id', $userId);
        }

        if ($status) {
            $model = $model->where('status', $status);
        }

        $leaves = $model->orderBy('start_date','DESC')->findAll();

        // compute summary counts for the current filtered set
        $counts = [
            'pending'  => 0,
            'approved' => 0,
            'rejected' => 0,
        ];
        foreach ($leaves as $l) {
            $s = isset($l['status']) ? $l['status'] : 'pending';
            if (! isset($counts[$s])) {
                $counts[$s] = 0;
            }
            $counts[$s]++;
        }

        $data['leaves'] = $leaves;
        $data['counts'] = $counts;
        $data['selectedStatus'] = $status;
        $data['userIdFilter'] = $userId;

        return view('reports/leaves', $data);
    }

    public function exportLeavesCsv()
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $status = $this->request->getGet('status');
        $userId = $this->request->getGet('user_id');

        $model = new LeaveModel();

        if (session()->get('role') !== 'admin') {
            $model = $model->where('user_id', session()->get('user_id'));
        } elseif ($userId) {
            $model = $model->where('user_id', $userId);
        }

        if ($status) {
            $model = $model->where('status', $status);
        }

        $leaves = $model->orderBy('start_date','DESC')->findAll();

        $filename = 'leaves_report_'.date('Ymd_His').'.csv';
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="'.$filename.'"');

        $out = fopen('php://output', 'w');
        fputcsv($out, ['ID','User ID','Start Date','End Date','Type','Reason','Status','Created At']);
        foreach ($leaves as $l) {
            fputcsv($out, [
                $l['id'] ?? '',
                $l['user_id'] ?? '',
                $l['start_date'] ?? '',
                $l['end_date'] ?? '',
                $l['type'] ?? '',
                $l['reason'] ?? '',
                $l['status'] ?? '',
                $l['created_at'] ?? '',
            ]);
        }
        fclose($out);
        exit;
    }
    
}