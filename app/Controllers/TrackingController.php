<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Tracking;
use App\Models\Crop;

class TrackingController extends BaseController
{
    protected $helpers = ['url', 'form', 'CIFunctions']; 
    protected $tracking;
    protected  $cropModel;

    
    public function __construct(){
        $this->cropModel = new Crop();
        $this->tracking = new Tracking();
    }

    public function index(){
        $data = array(
            'title'=>'Expenses |'
        );
        return view('backend/pages/tracking/expenses',$data);
    }

    public function sales(){
        $address = $this->cropModel->selectData('fields',null,null, array('User_ID' => get_user()->user_login_ID), 'address');
        $data = array(
            'title'=>'Sales |',
            'address' => $address
        );
        return view('backend/pages/tracking/sales',$data);
    }

    public function getSales(){
        $sales = $this->tracking->getSales();

        return json_encode($sales);
    }

    public function modifySales(){
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
                // 'vol' => [
                //     'rules' => 'required|greater_than[0]',
                //     'errors' => [
                //         'required' => 'Volume is required!',
                //         'greater_than' => 'Volume must greater than 0!'
                //     ]
                // ],
                'amount' => [
                    'rules' => 'required|greater_than[0]',
                    'errors' => [
                        'required' => 'Amount is required!',
                        'greater_than' => 'Amount must greater than 0!'
                    ]
                ]
                
            ]);
            if ($valid->run() == FALSE) {
                $errors = $valid->getErrors();
                return json_encode(['status' => 0, 'error' => $errors]);
            }else{
                $cropID = $req->getVar('cropID');
                $amount = $req->getVar('amount');

                $affectedRows = $this->tracking->modifySales($cropID, $amount);

                if ($affectedRows) {
                    return json_encode(['status' => 1]);
                } else {
                    return json_encode(['status' => 0]);
                }
            }   
        }
        
    }

    public function removeSales() {
        $ID = $this->request->getPost('ID');
        $affectedRows = $this->tracking->removeSales($ID);

        if ($affectedRows) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false, 'ID' => $ID]);
        }

    }
}
