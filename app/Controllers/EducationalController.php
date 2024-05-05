<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Main;
// use SSP;
class EducationalController extends BaseController
{
    protected $helpers = ['url', 'form', 'CIFunctions']; 
    protected $db;
    protected $mainModel;


    public function __construct(){
        $this->mainModel = new Main();
        // require_once APPPATH.'ThirdParty/ssp.php';
        $this->db = db_connect();
    }

    public function index()
    {
        $data = array(
            'title'=>'Smart Planting Guide |'
        );
        return view('backend/pages/educationals/smart-planting',$data);
    }

    public function pest()
    {
        $fetch = $this->mainModel->selectData('insecticides', null, null);
    
        $data = array(
            'title'=>'Pest Control |',
            'fetch'=>$fetch
        );
        return view('backend/pages/educationals/pest-control',$data);
    }

    public function fertilizer()
    {

        $fetch = $this->mainModel->selectData('fertilizers', null, null);

        $data = array(
            'title' => 'Fertilizer Friend |',
            'fetch' => $fetch
        );
        return view('backend/pages/educationals/fertilizer-friend',$data);
    }
}
