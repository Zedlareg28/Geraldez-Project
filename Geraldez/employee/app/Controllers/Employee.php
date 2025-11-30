<?php
namespace App\Controllers;

use App\Models\EmployeeModel;
use CodeIgniter\Controller;

class Employee extends Controller
{
    protected $employeeModel;
    protected $helpers = ['form', 'url', 'activity'];

    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
    }

    // List employees
    public function index()
    {
        $data['employees'] = $this->employeeModel->orderBy('fullname','ASC')->findAll();
        return view('employee/index', $data);
    }

    // Show create form
    public function create()
    {
        return view('employee/create');
    }

    // Store new employee
    public function store()
    {
        $rules = [
            'employee_id' => 'required|is_unique[employees.employee_id]|max_length[50]',
            'fullname'    => 'required|min_length[3]',
            'position'    => 'required|min_length[2]',
            'salary'      => 'permit_empty|decimal',
            'email'       => 'permit_empty|valid_email'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->employeeModel->save([
            'employee_id' => $this->request->getPost('employee_id'),
            'fullname'    => $this->request->getPost('fullname'),
            'position'    => $this->request->getPost('position'),
            'salary'      => $this->request->getPost('salary') ?: 0,
            'phone'       => $this->request->getPost('phone'),
            'email'       => $this->request->getPost('email'),
            'status'      => $this->request->getPost('status') ?: 'active'
        ]);

        log_activity('Added new employee: ' . $this->request->getPost('fullname'));

        return redirect()->to('/employees')->with('message','Employee added.');
    }

    // Show edit form
    public function edit($id = null)
    {
        $employee = $this->employeeModel->find($id);
        if (! $employee) {
            return redirect()->to('/employees')->with('error','Employee not found.');
        }
        return view('employee/edit', ['employee' => $employee]);
    }

    // Update employee
    public function update($id = null)
    {
        $data = $this->request->getPost(['fullname','position','salary','status']);
        // remove empty values so update() isn't called with an empty array
        $data = array_filter($data, function($v) { return $v !== null && $v !== ''; });

        if (empty($data)) {
            return redirect()->back()->with('error','No changes detected.');
        }

        $this->employeeModel->update($id, $data);

        return redirect()->to('/employees')->with('message','Employee updated.');
    }

    // Delete employee
    public function delete($id = null)
    {
        $this->employeeModel->delete($id);
        log_activity('Deleted employee ID: ' . $id);

        return redirect()->to('/employees')->with('message','Employee removed.');
    }

    // View single employee
    public function show($id = null)
    {
        $employee = $this->employeeModel->find($id);
        if (! $employee) {
            return redirect()->to('/employees')->with('error','Employee not found.');
        }
        return view('employee/show', ['employee' => $employee]);
    }
    public function staffList()
{
    $employeeModel = new \App\Models\EmployeeModel();
    $data['employees'] = $employeeModel->findAll();

    echo view('employee_list_staff', $data);
}

}
