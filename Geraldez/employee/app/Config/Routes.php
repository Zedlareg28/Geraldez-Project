<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', function() {
    return view('landing');
});
$routes->get('admin/login', 'Auth::adminLogin');  // if you created a separate admin login
$routes->get('staff/login', 'Auth::login');      // staff login
$routes->post('login/process', 'Auth::loginProcess');
$routes->post('admin/login/process', 'Auth::adminLoginProcess'); // if separate


// Employee management
$routes->get('employees', 'Employee::index');
$routes->get('employees/create', 'Employee::create');
$routes->post('employees/store', 'Employee::store');
$routes->get('employees/edit/(:num)', 'Employee::edit/$1');
$routes->post('employees/update/(:num)', 'Employee::update/$1');
$routes->get('employees/delete/(:num)', 'Employee::delete/$1');
$routes->get('employees/(:num)', 'Employee::show/$1');

// Default route
$routes->get('/login', 'Auth::login');
$routes->get('admin/system', 'SystemController::index');
$routes->post('admin/system/toggle', 'SystemController::toggle');

// Auth routes
$routes->get('login', 'Auth::login');
$routes->post('login/process', 'Auth::loginProcess');
$routes->get('register', 'Auth::register');
$routes->post('register/process', 'Auth::registerProcess');
$routes->get('logout', 'Auth::logout');

// Dashboards
$routes->get('dashboard/admin', 'Dashboard::admin');
$routes->get('dashboard/staff', 'Dashboard::staff');
$routes->get('/admin/logs', 'Dashboard::logs');
$routes->get('/activity', 'ActivityController::index');


//admin
$routes->get('admin/login', 'Auth::adminLogin');
$routes->post('admin/login/process', 'Auth::adminLoginProcess');

$routes->get('login', 'Auth::login');
$routes->post('login/process', 'Auth::loginProcess');

$routes->get('reports', 'Report::index');
$routes->get('reports/export', 'Report::exportCsv');

$routes->get('leaves', 'LeaveController::index');
$routes->get('leaves/create', 'LeaveController::create');
$routes->post('leaves/store', 'LeaveController::store');

$routes->get('admin/leaves', 'LeaveController::adminIndex');
$routes->get('admin/leaves/approve/(:num)', 'LeaveController::approve/$1');
$routes->get('admin/leaves/reject/(:num)', 'LeaveController::reject/$1');

$routes->get('reports/leaves', 'Report::leaves');
$routes->get('reports/leaves/export', 'Report::exportLeavesCsv');
$routes->get('employee_list_staff', 'EmployeeController::staffList');
$routes->get('admin/users/block/(:any)',    'UserController::blockUser/$1');
$routes->get('admin/users/unblock/(:any)',  'UserController::unblockUser/$1');
$routes->get('admin/users/block/(:any)',   'UserController::blockUser/$1');
$routes->get('admin/users/unblock/(:any)', 'UserController::unblockUser/$1');
$routes->get('register', 'Auth::register');
$routes->post('register/process', 'Auth::registerProcess');
$routes->get('/register', 'Auth::register');
$routes->post('/register/process', 'Auth::registerProcess');
