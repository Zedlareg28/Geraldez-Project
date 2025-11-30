<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\SystemStatusModel;

class MaintenanceFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // only run for HTTP requests
        if (PHP_SAPI === 'cli') {
            return;
        }

        $model = new SystemStatusModel();
        $row = $model->first();
        $status = $row ? ($row['status'] ?? 'online') : 'online';

        if ($status !== 'maintenance') {
            return;
        }

        // allow admin sessions or routes that must remain available for admins
        $role = session()->get('role');
        if ($role === 'admin') {
            return;
        }

        $uri = service('uri');
        $segment1 = strtolower($uri->getSegment(1) ?? '');

        // allow static assets and admin toggle routes if needed
        $allowedPrefixes = [
            'assets','css','js','img','images','favicon.ico','admin','system'
        ];

        if ($segment1 !== '' && in_array($segment1, $allowedPrefixes, true)) {
            return;
        }

        // show Whoops (development) / centralized error handler by throwing an exception
        // set HTTP status to 503 then throw to let CI render its error page
        $response = service('response');
        $response->setStatusCode(503);
        throw new \RuntimeException('Service Unavailable: The system is in maintenance mode.', 503);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // no-op
    }
}
