<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use SSP;

class WorkerController extends BaseController
{
    protected $helpers = ['url', 'form', 'CIFunctions']; 
    protected $db;

    public function __construct(){
        require_once APPPATH.'ThirdParty/ssp.php';
        $this->db = db_connect();
    }

    public function index()
    {
        $data = array(
            'title'=>'Worker |'
        );
        return view('backend/pages/worker',$data);
    }
}
