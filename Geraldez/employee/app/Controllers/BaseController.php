<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\SystemStatusModel;

class BaseController extends Controller
{
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        if (PHP_SAPI !== 'cli') {
            $systemModel = new SystemStatusModel();
            $row = $systemModel->first();
            $status = $row ? ($row['status'] ?? 'online') : 'online';

            $uri = service('uri');
            $path = trim($uri->getPath(), '/');
            $firstSegment = strtolower($uri->getSegment(1) ?? '');

            $allowed = ['admin','system','assets','css','js','img','images','favicon.ico','dashboard/staff'];

            $isAllowed = in_array($firstSegment, $allowed, true) || session()->get('role') === 'admin';

            if ($status === 'maintenance' && !$isAllowed) {
                echo view('dashboard/maintenance', ['status' => $status]);
                exit;
            }
        }
    }
}
