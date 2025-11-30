<?php

namespace App\Controllers;

use App\Models\EmployeeModel;

class EmployeeController extends BaseController
{
    public function staffList()
    {
        $employeeModel = new EmployeeModel();
        $data['employees'] = $employeeModel->findAll();

        echo view('employee_list_staff', $data);
    }
}
