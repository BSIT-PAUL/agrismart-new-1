<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Crop;
use App\Models\Main;
use App\Models\Setup;

class CropController extends BaseController
{
    protected $helpers = ['url', 'form', 'CIFunctions']; 
    protected  $cropModel;
    protected $mainModel;
    protected $setModel;

    public function __construct(){
        $this->setModel = new Setup();
        $this->cropModel = new Crop();
        $this->mainModel = new Main();
    }

    public function getPrice(){
        $type = $this->request->getPost('type');
        $seed = $this->request->getPost('seed');
        $supp = $this->request->getPost('supp');

        if(!empty($type) && !empty($seed) ){
            $price = $this->cropModel->getPrice(array('Type_ID' => $seed, 'Variety_ID' => $type));
        }else{
            if($type == 1){
                $table = 'insecticide';
            }else{
                $table = 'fertilizer';
            }
            $price = $this->mainModel->selectData($table, null, null, array('ID' => $supp));
        }
        return json_encode($price);
    }

    public function getAreaCrop(){

        $id = $this->request->getPost('ID');
        $where = $this->request->getPost('where');

        $seeds = $this->cropModel->getArea(array('User_ID' => get_user()->user_login_ID, 'Field_ID' => $id));

        $data = "";
        foreach ( $seeds as $row) {
            $data .= "<option value='".$row['Area_ID']."'>".$row['Area']."</option>";
        }
        echo json_encode($data);
        
        
    }

    //Crop

    public function index(){
        $fetch = $this->mainModel->selectData('seed_type',null,null);
        $address = $this->cropModel->selectData('fields',null,null, array('User_ID' => get_user()->user_login_ID), 'address');

        $data = array(
            'title'=> 'Crop |',
            'fetch'=> $fetch,
            'address'=> $address
        );
        return view('backend/pages/crops/crop',$data);
    }

    public function getCrops(){
        $ID = $this->request->getPost('ID');

        if(empty($ID)){
            $crops = $this->cropModel->getCrops();
        }else{
            $crops = $this->cropModel->getCrops(array('Crop_ID' => $ID));
        }
        

        return json_encode($crops);
    }

    public function getCrop(){
        $ID = $this->request->getPost('ID');

        $crops = $this->cropModel->getCrop(array('Area_ID' => $ID, 'c.User_ID' => get_user()->user_login_ID));
        return json_encode($crops);
    }

    public function getCropTotals(){
        $cropID = $this->request->getPost('ID');

        $crops = $this->cropModel->getCropTotals(array('s.Crop_ID' => $cropID));

        return json_encode($crops);
    }

    public function modifyCrops(){
        $req = \Config\Services::request();
        $valid = \Config\Services::validation();

        $seedValidationRules = 'greater_than[0]';

        // Check if the 'seed' value is 'others', if so, remove the 'greater_than[0]' rule
        if ($req->getVar('seed') == 'other') {
            $seedValidationRules = 'required'; // Set empty rule
        }

        $typeValidationRules = 'greater_than[0]';

        // Check if the 'seed' value is 'others', if so, remove the 'greater_than[0]' rule
        if ($req->getVar('type') == 'other') {
            $typeValidationRules = 'required'; // Set empty rule
        }

        if ($req->isAJAX()) {
            $this->validate([
                'address' => [
                    'rules' => 'greater_than[0]',
                    'errors' => [
                        'greater_than' => 'Address is required!'
                    ]
                ],
                'field' => [
                    'rules' => 'greater_than[0]',
                    'errors' => [
                        'greater_than' => 'Field is required!'
                    ]
                ],
                'area' => [
                    'rules' => 'greater_than[0]',
                    'errors' => [
                        'greater_than' => 'Area is required!'
                    ]
                ],
                'seed' => [
                    'rules' => $seedValidationRules,
                    'errors' => [
                        'requires' => 'Seed is required!',
                        'greater_than' => 'Seed is required!'
                    ]
                ],
                'type' => [
                    'rules' => $typeValidationRules,
                    'errors' => [
                        'requires' => 'Seed type is required!',
                        'greater_than' => 'Seed type is required!'
                    ]
                ]
                
            ]);

            if ($valid->run() == FALSE) {
                $errors = $valid->getErrors();
                return json_encode(['status' => 0, 'error' => $errors]);
            }else{
                $areaID = $req->getVar('areaID');
                $seed = $req->getVar('seedVal');
                $type = $req->getVar('typeVal');
                $price = $req->getVar('price');
                $seedVol = $req->getVar('qty');

                $affectedRows = $this->cropModel->modifyCrop($price, $seed, $type, $areaID, $seedVol);

                if ($affectedRows) {
                    // $user_info = $this/->userModel->getUserDetails($user);
                    return json_encode(['status' => 1]);
                } else {
                    return json_encode(['status' => 0]);
                }
            }   
        }
        
    }
    
    public function removeCrop() {
        $ID = $this->request->getPost('ID');
        $affectedRows = $this->cropModel->removeCrop($ID);

        if ($affectedRows) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false, 'ID' => $ID]);
        }

    }

    public function viewCrop() {
        $data = array(
            'title'=>'View Crop |'
        );
        return view('backend/pages/crops/view_crop',$data);
    }

    //Seed

    public function seed(){
        $data = array(
            'title'=>'Seed |'
        );
        return view('backend/pages/crops/seed',$data);
    }

    public function getSeeds(){
        $seed = $this->cropModel->getSeeds(null);

        return json_encode($seed);
    }

    public function getSeed(){

        $id = $this->request->getPost('ID');
        $where = $this->request->getPost('where');
        $seeds = $this->cropModel->getSeeds($id,array($where => $id));

        if($where == "s.seedID"){
            return json_encode($seeds);
        }else{
            $data = "";
            foreach ( $seeds as $row) {
                $data .= "<option value='".$row['Variety_ID']."'>".$row['Variety']."</option>";
            }
            $data .= "<option value='other'>Other</option>";
            echo json_encode($data);
        }
        
    }

    public function removeSeed() {
        $ID = $this->request->getPost('ID');
        $affectedRows = $this->cropModel->removeSeed($ID);

        if ($affectedRows) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false, 'ID' => $ID]);
        }

    }

    public function viewSeed() {
        $data = array(
            'title'=>'View Seed |'
        );
        return view('backend/pages/crops/view_seed',$data);
    }

    //Supplement

    public function supplement(){
        $address = $this->cropModel->selectData('fields',null,null, array('User_ID' => get_user()->user_login_ID), 'address');
        $data = array(
            'title'=>'Supplement |',
            'address' => $address
        );
        return view('backend/pages/crops/supplement',$data);
    }

    public function getSupplement(){
        $ID = $this->request->getPost('ID');

        $supp;

        if(empty($ID)){
            $supp = $this->cropModel->getSupps(array('s.User_ID' => get_user()->user_login_ID));
        }else{
            $supp = $this->cropModel->getSupps(array('s.User_ID' => get_user()->user_login_ID, 's.ID' => $ID));
        }
        return json_encode($supp);
    }

    public function supplements(){
        $type = $this->request->getPost('type');

        $table;
        $field;

        if($type == 1){
            $ID = 'Insecticide_ID';
            $field = 'Insecticide';
            $supplement = $this->setModel->getInsecticides(null);
        }else{
            $ID = 'Fertilizer_ID';
            $field = 'Fertilizer';
            $supplement = $this->setModel->getFertilizers(null);
        }
        // $supplement = $this->mainModel->selectData($table,null,null);
        $data = "";
        foreach ( $supplement as $row) {
            $data .= "<option value='".$row[$ID]."'>".$row[$field]."</option>";
        }
        echo json_encode($data);
    }

    public function modifySupplement(){
        $req = \Config\Services::request();
        $valid = \Config\Services::validation();

        $suppValidationRules = 'greater_than[0]';

        // Check if the 'seed' value is 'others', if so, remove the 'greater_than[0]' rule
        if ($req->getVar('supp') == 'other') {
            $suppValidationRules = 'required'; // Set empty rule
        }

        if ($req->isAJAX()) {
            $this->validate([
                'address' => [
                    'rules' => 'greater_than[0]',
                    'errors' => [
                        'greater_than' => 'Address is required!'
                    ]
                ],
                'field' => [
                    'rules' => 'greater_than[0]',
                    'errors' => [
                        'greater_than' => 'Field is required!'
                    ]
                ],
                'area' => [
                    'rules' => 'greater_than[0]',
                    'errors' => [
                        'greater_than' => 'Area is required!'
                    ]
                ],
                'supp' => [
                    'rules' => $suppValidationRules,
                    'errors' => [
                        'requires' => 'Suplement is required!',
                        'greater_than' => 'Suplement is required!'
                    ]
                ],
                'type' => [
                    'rules' => 'greater_than[0]',
                    'errors' => [
                        'greater_than' => 'Supplement type is required!'
                    ]
                ],
                'price' => [
                    'rules' => 'greater_than[0]',
                    'errors' => [
                        'greater_than' => 'Price must greater than 0'
                    ]
                ]
                
            ]);
            if ($valid->run() == FALSE) {
                $errors = $valid->getErrors();
                return json_encode(['status' => 0, 'error' => $errors]);
            }else{
                $areaID = $req->getVar('areaID');
                $supp = $req->getVar('suppVal');
                $type = $req->getVar('typeVal');
                $price = $req->getVar('price');
                $qty = $req->getVar('qty');

                $affectedRows = $this->cropModel->modifySupp($type, $areaID, $qty, $supp, $price);

                if ($affectedRows) {
                    // $user_info = $this/->userModel->getUserDetails($user);
                    return json_encode(['status' => 1]);
                } else {
                    return json_encode(['status' => 0]);
                }
            }   
        }
        
    }

    public function removeSupp() {
        $ID = $this->request->getPost('ID');
        $affectedRows = $this->cropModel->removeSupp($ID);

        if ($affectedRows) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false, 'ID' => $ID]);
        }

    }

    public function viewSupp() {
        $data = array(
            'title'=>'View Supplement |'
        );
        return view('backend/pages/crops/view_supp',$data);
    }

    //Water Schedule
    public function waterSched(){
        $address = $this->cropModel->selectData('fields',null,null, array('User_ID' => get_user()->user_login_ID), 'address');
        $data = array(
            'title'=>'Water Schedule |',
            'address'=>$address
        );
        return view('backend/pages/crops/waterSched',$data);
    }

    public function getwaterSched(){
        $ID = $this->request->getPost('ID');

        if(empty($ID)){
            $sched = $this->cropModel->getwaterSchedules(array('ws.User_ID' => get_user()->user_login_ID));
        }else{
            $sched = $this->cropModel->getwaterSchedules(array('ws.User_ID' => get_user()->user_login_ID, 'ws.ID'=>$ID));
        }

        return json_encode($sched);
    }

    public function modifyWatering(){
        $req = \Config\Services::request();
        $valid = \Config\Services::validation();

        if ($req->isAJAX()) {
            
            $this->validate([
                'address' => [
                    'rules' => 'greater_than[0]',
                    'errors' => [
                        'greater_than' => 'Address is required!'
                    ]
                ],
                'field' => [
                    'rules' => 'greater_than[0]',
                    'errors' => [
                        'greater_than' => 'Field is required!'
                    ]
                ],
                'area' => [
                    'rules' => 'required|greater_than[0]',
                    'errors' => [
                        'required' => 'Area is required!',
                        'greater_than' => 'Area is required!'
                    ]
                ],
                'cost' => [
                    'rules' => 'required|greater_than[0]',
                    'errors' => [
                        'required' => 'Cost is required!',
                        'greater_than' => 'Cost must greater than 0!'
                    ]
                ]
                
            ]);
            if ($valid->run() == FALSE) {
                $errors = $valid->getErrors();
                return json_encode(['status' => 0, 'error' => $errors]);
            }else{
                $cropID = $req->getVar('cropID');
                $cost = $req->getVar('cost');

                $affectedRows = $this->cropModel->modifyWatering($cropID, $cost);

                if ($affectedRows) {
                    return json_encode(['status' => 1]);
                } else {
                    return json_encode(['status' => 0]);
                }
            }   
        }
        
    }

    public function removeWatering() {
        $ID = $this->request->getPost('ID');
        $affectedRows = $this->cropModel->removeWatering($ID);

        if ($affectedRows) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false, 'ID' => $ID]);
        }

    }

}

