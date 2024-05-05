<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\CIAuth;
use App\Models\User;
use App\Libraries\Hash;
use App\Models\Dashboard;
// use SSP;

class AdminController extends BaseController
{

    protected $helpers = ['url', 'form', 'CIFunctions']; 
    protected $db;
    protected $userModel;
    protected $dashboard;

    public function __construct(){
        // require_once APPPATH.'ThirdParty/ssp.php';
        $this->dashboard = new Dashboard();
        $this->userModel = new User();
        $this->db = db_connect();
    }

    public function index(){
        $reportingYr = $this->dashboard->getYr(array('User_ID' => get_user()->user_login_ID, 'harvestDate != '=> "NULL"));
        $data = [
            'title'=>'Dashboard',
            'yr' => $reportingYr
        ];

        return view('backend/pages/home',$data);
    }

    public function getTotals(){

        $yr = $this->request->getPost('yr');
        if($yr != 0){
            $totals = $this->dashboard->getTotals(array('User_ID' => get_user()->user_login_ID, 'YEAR(harvestDate)' => $yr));
        }else{
            $totals = $this->dashboard->getTotals(array('User_ID' => get_user()->user_login_ID));
        }
        

        return json_encode($totals);
    }

    public function harvestCrops(){
        $yr = $this->request->getPost('yr');
        if($yr != 0){
            $totals = $this->dashboard->harvestCrops(0,array('User_ID' => get_user()->user_login_ID, 'YEAR(harvestDate)' => $yr, 'harvestDate != '=> "NULL"));
        }else{
            $totals = $this->dashboard->harvestCrops(0, array('User_ID' => get_user()->user_login_ID, 'harvestDate != '=> "NULL"));
        }
        
        return json_encode($totals);
    }


    public function harvestCropsChart(){
        $yr = $this->request->getPost('yr');
        if($yr != 0){
            $totals = $this->dashboard->harvestCrops(1,array('User_ID' => get_user()->user_login_ID, 'YEAR(harvestDate)' => $yr, 'harvestDate != '=> "NULL"));
        }else{
            $totals = $this->dashboard->harvestCrops(1, array('User_ID' => get_user()->user_login_ID, 'harvestDate != '=> "NULL"));
        }
        
        return json_encode($totals);
    }

    public function getProfit(){

        $yr = $this->request->getPost('yr');
        if($yr != 0){
            $cropProfit = $this->dashboard->getProfit(array('User_ID' => get_user()->user_login_ID, 'YEAR(harvestDate)' => $yr));
        }else{
            $cropProfit = $this->dashboard->getProfit(array('User_ID' => get_user()->user_login_ID));
        }
        return json_encode($cropProfit);
    }

    public function getSales(){

        $yr = $this->request->getPost('yr');
        if($yr != 0){
            $cropProfit = $this->dashboard->getSales(array('User_ID' => get_user()->user_login_ID, 'YEAR(s.dateCreated)' => $yr));
        }else{
            $cropProfit = $this->dashboard->getSales(array('User_ID' => get_user()->user_login_ID));
        }
        return json_encode($cropProfit);
    }

    public function getExpenses(){

        $yr = $this->request->getPost('yr');
        if($yr != 0){
            $cropProfit = $this->dashboard->getExpenses(array('c.User_ID' => get_user()->user_login_ID, 'YEAR(e.dateCreated)' => $yr));
        }else{
            $cropProfit = $this->dashboard->getExpenses(array('c.User_ID' => get_user()->user_login_ID));
        }
        return json_encode($cropProfit);
    }
    public function logoutHandler()
    {
        CIAuth::forget();
        return redirect()->route('admin.login.form')->with('fail','You are logged out!');
    }

    public function profile(){
        
        $data = array(
            'title'=>'Profile |'
        );
        return view('backend/pages/profile',$data);
    }

    public function updateProfile(){
        $req = \Config\Services::request();
        $valid = \Config\Services::validation();
        $user = CIAuth::id();

        if ($req->isAJAX()) {
            $this->validate([
                'fname' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'First name is required!'
                    ]
                ],
                'lname' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Last name is required!'
                    ]
                ],
                'contact' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Contact is required!'
                    ]
                ],
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Email address is required!',
                        'valid_email' => 'Please enter a valid email address.'
                    ]
                ]
                
            ]);

            if ($valid->run() == FALSE) {
                $errors = $valid->getErrors();
                return json_encode(['status' => 0, 'error' => $errors, 'ID' => $user]);
            } else {
                $fname = $req->getVar('fname');
                $lname = $req->getVar('lname');
                $contact = $req->getVar('contact');
                $email = $req->getVar('email');

                $update = $this->userModel->modifyUser($user, $fname, $lname, $email, $contact);

                if ($update) {
                    $user_info = $this->userModel->getUserDetails($user);
                    return json_encode(['status' => 1, 'msg' => 'Profile updated successfully!', 'user_info' => $user_info]);
                } else {
                    return json_encode(['status' => 0, 'msg' => 'Failed to update profile!']);
                }
            }
        }
    }

    public function updateAvatar(){
        $req = \Config\Services::request();
        $valid = \Config\Services::validation();
        $user = CIAuth::id();
        $user_info = $this->userModel->getUserDetails($user);

        $path = 'public/images/users/';
        $file = $req->getFile('user_profile');
        $old_pic = $user_info->Profile;
        $new_filename = 'UIMG_'.$user.$file->getRandomName();

        $uploadFile = \Config\Services::image()
                    ->withFile($file)
                    ->resize(450,450,true,'height')
                    ->save($path.$new_filename);
            
        if($uploadFile){
            if( $old_pic != null && file_exists($path.$new_filename)){
                unlink($path.$old_pic);
            }

            $update = $this->userModel->modifyUser($user, null, null, null, null, $new_filename);

            if ($update) {
                $user_info = $this->userModel->getUserDetails($user);
                // return $this->response->setJSON(['status' => 1, 'msg' => 'Your Avatar has been successfully updated.']);
                return json_encode(['status' => 1, 'msg' => 'Your Avatar has been successfully updated.', 'file' => $new_filename]);
            } else {
                return json_encode(['status' => 0, 'msg' => 'Something went wrong']);
            }
        }else{
            return json_encode(['status' => 0, 'msg' => 'Something went wrong']);
        }
    }

    public function changePassword(){
        $req = \Config\Services::request();
        $valid = \Config\Services::validation();
        $user = CIAuth::id();
        $user_info = $this->userModel->getUserDetails($user);

        $this->validate([
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username is required.'
                ]
            ],
            'current_password' => [
                'rules' => 'required|min_length[5]|check_curr_pass[current_password]',
                'errors' => [
                    'required' => 'Current password is required.',
                    'min_length' => 'Current password must have at least 5 characters.',
                    'check_curr_pass' => "Incorrect password."
                ]
            ],
            'new_password' => [
                'rules' => 'required|min_length[5]|max_length[20]|IsPasswordStrong[new_password]',
                'errors' => [
                    'required' => 'New Password is required.',
                    'min_length' => 'New password must have at least 5 characters.',
                    'max_length' => 'New password must not excess more than 20 characters.',
                    'IsPasswordStrong' => 'New password must contains atleast 1 uppercase and a number.'
                ],
            ],
            'confirm_password' => [
                'rules' => 'required|matches[new_password]',
                'errors' => [
                    'required' => 'Confirmation password is required.',
                    'matches' => 'Password not matches.'
                ]
            ]
         ]);

         if ($valid->run() == FALSE) {
            $errors = $valid->getErrors();
            return json_encode(['status' => 0, 'error' => $errors, 'token' => csrf_hash()]);
        } else {
            $username = $req->getVar('username');
            $pass = $req->getVar('new_password');
            $hashPassword = Hash::make($pass);

            $update = $this->userModel->modifyUserLogin($user, $username, $hashPassword);

            if ($update) {
                $user_info = $this->userModel->getUserDetails($user);
                return json_encode(['status' => 1, 'msg' => 'Profile updated successfully!', 'user_info' => $user_info]);
            } else {
                return json_encode(['status' => 0, 'msg' => 'Failed to update profile!']);
            }
            return json_encode(['status' => 1, 'msg' => 'Good', 'token' => csrf_hash()]);
        }
    }

}