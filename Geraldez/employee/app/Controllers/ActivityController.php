<?php
namespace App\Controllers;

use App\Models\UserActivityModel;

class ActivityController extends BaseController
{
    protected $activityModel;

    public function __construct()
    {
        $this->activityModel = new UserActivityModel();
    }

    // List all user activities
    public function index()
    {
        $data['activities'] = $this->activityModel
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('activity/index', $data);
    }
}
