<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\HumanResource;

class HumanResourceController extends BaseController
{
    protected $helpers = ['url', 'form', 'CIFunctions']; 
    protected  $HRModel;

    public function __construct(){
        $this->HRModel = new HumanResource();
    }

    //vendor
    public function index()
    {
        $data = array(
            'title'=>'Vendor |'
        );
        return view('backend/pages/human_resource/vendor',$data);
    }

    public function getVendors(){
         
        $vendors = $this->HRModel->getVendors();

        return json_encode($vendors);
    }

    //worker
    public function worker(){
        $data = array(
            'title'=>'Worker |'
        );
        return view('backend/pages/human_resource/worker',$data);
    }

    public function getWorkers(){
         
        $workers = $this->HRModel->getWorkers();

        return json_encode($workers);
    }
}
