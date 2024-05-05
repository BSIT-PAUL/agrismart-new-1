<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use App\Models\Field;
use App\Models\Crop;
use App\Models\Main;

class FieldController extends BaseController
{
    protected $helpers = ['url', 'form', 'CIFunctions']; 
    protected  $fieldModel;
    protected $mainModel;
    protected  $cropModel;
    use ResponseTrait;

    public function __construct(){
        $this->fieldModel = new Field();
        $this->cropModel = new Crop();
        $this->mainModel = new Main();
    }

    public function index()
    {
        $fetch = $this->mainModel->selectData('city',null,null);
        $data = array(
            'title'=>'Field |',
            'fetch' => $fetch
        );
        return view('backend/pages/fields/field',$data);
    }

    public function municipality(){
        $cityID = $this->request->getPost('cityID');
        $municipality = $this->mainModel->selectData('municipality m','city c','m.City_ID = c.City_ID',array('c.City_ID'=> $cityID));
        $data = "";
        foreach ( $municipality as $row) {
            $data .= "<option value=".$row['Municipality_ID'].">".$row['Municipality']."</option>";
        }
        echo json_encode($data);
    }

    public function city(){
        $countryID = $this->request->getPost('countryID');
        $city = $this->mainModel->selectData('city c','country co','c.Country_ID = co.Country_ID',array('co.Country_ID'=> $countryID));
        $data = "";
        foreach ( $city as $row) {
            $data .= "<option value=".$row['City_ID'].">".$row['City']."</option>";
        }
        echo json_encode($data);
    }

    public function barangay(){
        $muniID = $this->request->getPost('muniID');
        $brgy = $this->mainModel->selectData('barangay b','municipality m','m.Municipality_ID = b.Municipality_ID',array('m.Municipality_ID'=> $muniID));
        $data = "";
        foreach ( $brgy as $row) {
            $data .= "<option value=".$row['Barangay_ID'].">".$row['Barangay']."</option>";
        }
        echo json_encode($data);
    }

    public function getFields(){
        $userID = $this->request->getPost('userID');
        $fields = $this->fieldModel->getFields($userID);

        return json_encode($fields);
    }

    public function getField(){
        $ID = $this->request->getPost('ID');
        $where = $this->request->getPost('where');
        $field = $this->fieldModel->getField(array($where => $ID, 'User_ID' => get_user()->user_login_ID));

        if($where == "fieldID"){
            return json_encode($field);
        }else{
            $data = "";
            foreach ( $field as $row) {
                $data .= "<option value='".$row['fieldID']."'>".$row['Field']."</option>";
            }
            echo json_encode($data);
        }
    }

    
    public function modifyField(){
        $req = \Config\Services::request();
        $valid = \Config\Services::validation();

        if ($req->isAJAX()) {
            
            $this->validate([
                'brgy' => [
                    'rules' => 'greater_than[0]',
                    'errors' => [
                        'greater_than' => 'Barangay is required!'
                    ]
                ],
                'city' => [
                    'rules' => 'greater_than[0]',
                    'errors' => [
                        'greater_than' => 'City is required!'
                    ]
                ],
                'muni' => [
                    'rules' => 'greater_than[0]',
                    'errors' => [
                        'greater_than' => 'Municipality is required!'
                    ]
                ]
            ]);
            if ($valid->run() == FALSE) {
                $errors = $valid->getErrors();
                return json_encode(['status' => 0, 'error' => $errors]);
            }else{
                $brgyID = $req->getVar('brgy');

                $affectedRows = $this->fieldModel->modifyField(get_user()->User_ID, $brgyID);

                if ($affectedRows) {
                    // $user_info = $this/->userModel->getUserDetails($user);
                    return json_encode(['status' => 1]);
                } else {
                    return json_encode(['status' => 0]);
                }
            }   
        }
        
    }

    public function removeField() {
        $ID = $this->request->getVar('ID');

        
        $affectedRows = $this->fieldModel->removeField($ID);

        if ($affectedRows) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }

    public function viewField() {
        $data = array(
            'title'=>'View Field |',
        );
        return view('backend/pages/fields/view_field',$data);
    }

    //Area
    public function area(){
        $address = $this->cropModel->selectData('fields',null,null, array('User_ID' => get_user()->user_login_ID), 'address');
        $data = array(
            'title'=>'Area |',
            'address' => $address
        );
        return view('backend/pages/fields/area',$data);
    }

    public function getAreas(){
        $areas = $this->fieldModel->getAreas(array('User_ID' => get_user()->user_login_ID), 'Area_ID');

        return json_encode($areas);
    }
    public function getAreaByField(){
        $fieldID = $this->request->getVar('id');

        $areas = $this->fieldModel->getAreaByField($fieldID);

        return json_encode($areas);
    }

    public function getAreaName(){
        $fieldID = $this->request->getVar('fieldID');

        $areas = $this->fieldModel->getAreaName($fieldID);

        return json_encode($areas);
    }

    public function getArea(){

        $id = $this->request->getPost('ID');
        $where = $this->request->getPost('where');
        $custom = $this->request->getPost('custom');
        $tab = $this->request->getPost('tab');

        $areas;

        if($custom == 1){
            $areas = $this->mainModel->selectData('fields',null,null, array('fieldID' => $id));
            return json_encode($areas);
        }else{
            if($where == 'Area_ID'){
                $areas = $this->fieldModel->getAreas(array($where => $id, 'User_ID' => get_user()->user_login_ID));
                return json_encode($areas);

            }else if($where == 'fieldID'){
                if($tab == 'supp'){
                    $areas = $this->fieldModel->getAreas(array('User_ID' => get_user()->user_login_ID, $where => $id, 'crop != ' => '-'));

                    $data = "";
                    foreach ( $areas as $row) {
                        $data .= "<option value='".$row['cropID']."'>".$row['Area']."</option>";
                    }
                    echo json_encode($data);
                }else{
                    $areas = $this->fieldModel->getAreas(array('User_ID' => get_user()->user_login_ID, $where => $id));

                    $data = "";
                    foreach ( $areas as $row) {
                        $data .= "<option value='".$row['Area_ID']."'>".$row['Area']."</option>";
                    }
                    echo json_encode($data);
                }

            }else{
                $areas = $this->fieldModel->getAreas(array('User_ID' => get_user()->user_login_ID, 'Area_ID' => $id));
                return json_encode($areas);
            }
            
        }
        

        
    }

    public function modifyArea(){
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
                'lotArea' => [
                    'rules' => 'required|greater_than[0]',
                    'errors' => [
                        'required' => 'Lot Area is required!',
                        'greater_than' => 'Lot area must greater than 0!'
                    ]
                ]
                
            ]);
            if ($valid->run() == FALSE) {
                $errors = $valid->getErrors();
                return json_encode(['status' => 0, 'error' => $errors]);
            }else{
                $ID = $req->getVar('areaID');
                $fieldID = $req->getVar('field');
                $lotArea = $req->getVar('lotArea');

                $affectedRows = $this->fieldModel->modifyArea($ID, $fieldID, $lotArea);

                if ($affectedRows) {
                    // $user_info = $this/->userModel->getUserDetails($user);
                    return json_encode(['status' => 1]);
                } else {
                    return json_encode(['status' => 0]);
                }
            }   
        }
        
    }

    public function removeArea() {
        $ID = $this->request->getPost('ID');
        $affectedRows = $this->fieldModel->removeArea($ID);

        if ($affectedRows) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false, 'ID' => $ID]);
        }

    }

    public function viewArea() {
        $data = array(
            'title'=>'View Area |'
        );
        return view('backend/pages/fields/view_area',$data);
    }

    public function getExpenses(){
        // $areaID = $this->request->getVar('areaID');
        $cropID = $this->request->getVar('cropID');
        $con = $this->request->getVar('con');

        if(empty($con)){    
            $areas = $this->fieldModel->getExpenses(array('e.Crop_ID' => $cropID));
        }else{
            $areas = $this->fieldModel->getExpenses(array('e.Crop_ID' => $cropID, 'type != '=> 'Equipment'));
        }
       

        return json_encode($areas);
    }

}
