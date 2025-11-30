<?php

use App\Models\UserActivityModel;

if (!function_exists('log_activity')) {
    function log_activity($activity) {
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'N/A';
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'N/A';

        $data = [
            'username'   => session()->get('username') ?? 'guest',
            'activity'   => $activity,
            'ip_address' => $ip,
            'mac_address'=> 'N/A', // cannot get real MAC
            'created_at' => date('Y-m-d H:i:s')
        ];

        $activityModel = new UserActivityModel();
        $activityModel->insert($data);
    }
}
