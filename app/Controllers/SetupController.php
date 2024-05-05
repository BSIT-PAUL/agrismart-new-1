<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Main;
use App\Models\Setup;

class SetupController extends BaseController
{
    protected $helpers = ['url', 'form', 'CIFunctions'];
    protected $mainModel;
    protected $setModel;

    public function __construct(){
        $this->mainModel = new Main();
        $this->setModel = new Setup();
    }

    // fertilizer
    public function index()
    {
        return view('backend/pages/setup/fertilizer');
    }

    public function getFertilizers(){
         
        $fertilizers = $this->setModel->getFertilizers(null);

        return json_encode($fertilizers);
    }

    public function getFertilizer(){
        $id = $this->request->getPost('ID');
        $where = $this->request->getPost('where');
        $fertilizers = $this->setModel->getFertilizers($id, array($where => $id));

        return json_encode($fertilizers);
    }

    public function modifyFertilizer() {
        $req = \Config\Services::request();
        $valid = \Config\Services::validation();

        if ($req->isAJAX()) {
            $this->validate([
                'fertilizer' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Fertilizer is required!'
                    ]
                ], 'price' => [
                    'rules' => 'required|greater_than[0]',
                    'errors' => [
                        'required' => 'Price is required!',
                        'greater_than' => 'Price must greater than 0!'
                    ]
                ], 'descp' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Description is required!'
                    ]
                ]
            ]);
        }

        if ($valid->run() == FALSE) {
            $errors = $valid->getErrors();
            return json_encode(['status' => 0, 'error' => $errors]);
        } else {
            $fert = $req->getVar('fert');
            $pric = $req->getVar('pric');
            $desc = $req->getVar('desc');
            $fer_ID = $req->getVar('fer_ID');
            $photo = $req->getVar('photo');

            $affectedRows = $this->setModel->modifyFertilizer(get_user()->user_login_ID, $fert, $desc, $pric, $fer_ID, $photo);

            if ($affectedRows) {
                return json_encode(['status' => 1]);
            } else {
                return json_encode(['status' => 0]);
            }
        }
    }

    public function removeFertilizer() {
        $ID = $this->request->getPost('ID');
        $affectedRows = $this->setModel->removeFertilizer($ID, get_user()->user_login_ID);

        if ($affectedRows) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false, 'ID' => $ID]);
        }
    }

    public function updateFertPhoto() {
        $req = \Config\Services::request();

        $path = 'public/images/fertilizers/';
        $file = $req->getFile('fer_photo');
        $new_filename = 'UIMG_'.$file->getRandomName();
        $uploadFile = \Config\Services::image()
                    ->withFile($file)
                    ->resize(450,450,true,'height')
                    ->save($path.$new_filename);

        if ($uploadFile) {
            return json_encode(['status'=>1, 'msg'=>$new_filename]); 
        }
    }

    // insecticide
    public function insecticide()
    {
        return view('backend/pages/setup/insecticide');
    }

    public function getInsecticides(){
         
        $insecticides = $this->setModel->getInsecticides(null);

        return json_encode($insecticides);
    }

    public function getInsecticide(){
        $id = $this->request->getPost('ID');
        $where = $this->request->getPost('where');

        $insecticides = $this->setModel->getInsecticides($id, array('Insecticide_ID' => $id));

        return json_encode($insecticides);
    }

    public function modifyInsecticide() {
        $req = \Config\Services::request();
        $valid = \Config\Services::validation();

        if ($req->isAJAX()) {
            $this->validate([
                'insecticide' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Insecticide is required!'
                    ]
                ], 'price' => [
                    'rules' => 'required|greater_than[0]',
                    'errors' => [
                        'required' => 'Price is required!',
                        'greater_than' => 'Price must greater than 0!'
                    ]
                ], 'descp' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Description is required!'
                    ]
                ]
            ]);
        }

        if ($valid->run() == FALSE) {
            $errors = $valid->getErrors();
            return json_encode(['status' => 0, 'error' => $errors]);
        } else {
            $inse = $req->getVar('inse');
            $pric = $req->getVar('pric');
            $desc = $req->getVar('desc');
            $ins_ID = $req->getVar('ins_ID');
            $photo = $req->getVar('photo');

            $affectedRows = $this->setModel->modifyInsecticide(get_user()->user_login_ID, $inse, $desc, $pric, $ins_ID, $photo);

            if ($affectedRows) {
                return json_encode(['status' => 1]);
            } else {
                return json_encode(['status' => 0]);
            }
        }
    }

    public function removeInsecticide() {
        $ID = $this->request->getPost('ID');
        $affectedRows = $this->setModel->removeInsecticide($ID, get_user()->user_login_ID);

        if ($affectedRows) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false, 'ID' => $ID]);
        }
    }

    public function updateInsePhoto() {
        $req = \Config\Services::request();

        $path = 'public/images/insecticides/';
        $file = $req->getFile('ins_photo');
        $new_filename = 'UIMG_'.$file->getRandomName();
        $uploadFile = \Config\Services::image()
                    ->withFile($file)
                    ->resize(450,450,true,'height')
                    ->save($path.$new_filename);

        if ($uploadFile) {
            return json_encode(['status'=>1, 'msg'=>$new_filename]); 
        }
    }

    // seed
    public function seed(){
        return view('backend/pages/setup/seed');
    }

    public function getSeeds(){
        $seed = $this->setModel->getSeeds(null);

        return json_encode($seed);
    }

    public function getSeed(){
        $id = $this->request->getPost('ID');
        $where = $this->request->getPost('where');
        $seeds = $this->setModel->getSeeds($id,array($where => $id));

        return json_encode($seeds);
    }

    public function viewSeed() {
        return view('backend/pages/setup/view_seed');
    }

    public function modifySeed() {
        $req = \Config\Services::request();
        $valid = \Config\Services::validation();

        if ($req->isAJAX()) {
            $this->validate([
                'seedType' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Seed is required!'
                    ]
                ], 'seedVariety' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Seed type is required!'
                    ]
                ], 'descp' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Description is required!'
                    ]
                ],
                'price' => [
                    'rules' => 'required|greater_than[0]',
                    'errors' => [
                        'required' => 'Price is required!',
                        'greater_than' => 'Price must greater than 0!'
                    ]
                ]
            ]);
        }

        if ($valid->run() == FALSE) {
            $errors = $valid->getErrors();
            return json_encode(['status' => 0, 'error' => $errors]);
        } else {
            $type = $req->getVar('type');
            $variety = $req->getVar('variety');
            $price = $req->getVar('price');
            $descp = $req->getVar('descp');
            $seed_ID = $req->getVar('seed_ID');

            $affectedRows = $this->setModel->modifySeed(get_user()->user_login_ID, $type, $variety,$price, $descp);

            if ($affectedRows) {
                return json_encode(['status' => 1]);
            } else {
                return json_encode(['status' => 0]);
            }
        }
    }

    public function removeSeed() {
        $ID = $this->request->getPost('ID');
        $affectedRows = $this->setModel->removeSeed($ID, get_user()->user_login_ID);

        if ($affectedRows) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false, 'ID' => $ID]);
        }
    }
}