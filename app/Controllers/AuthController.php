<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\CIAuth;
use App\Libraries\Hash;
use App\Models\User;
use App\Models\PasswordResetToken;
use Carbon\Carbon;

class AuthController extends BaseController
{
    protected $helpers = ['url','form', 'CIFunctions', 'CIMail'];
    protected  $userModel;

    public function __construct(){
        $this->userModel = new User();
    }

    public function loginForm()
    {
        $data =[
            'title'=>'Login | ',
            'validation'=>null
        ];

        return view('backend/pages/auth/login', $data);
    }

    public function loginHandler(){
        $isValid = $this->validate([
            'username' => [
                'rules' => 'required|is_not_unique[user_login.Username]',
                'errors' => [
                    'required' => 'Username is required',
                    'is_not_unique' => 'Incorrect username!'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password is required'
                ]
            ]
        ]);
        
        if (!$isValid) {
            return view('backend/pages/auth/login', [
                'title' => 'Login |',
                'validation' => $this->validator
            ]);
        } else {
            $user = new User();
            $username = $this->request->getVar('username');
            $userInfo = $user->getUserByUsername($username);

            if (!$userInfo || $userInfo['Username'] !== $username) {
                return redirect(base_url('admin.login.form'))->with('fail', 'Username or password is incorrect')->withInput();
            }

            // Verify the password
            if (!password_verify($this->request->getVar('password'), $userInfo['Password'])) {
                return redirect(base_url('admin.login.form'))->with('fail', 'Username or password is incorrect')->withInput();
            }

            CIAuth::setCIAuth($userInfo);
            return redirect('admin.home');
        }
        
    }

    // forgot
    public function forgotForm() {
        $data = array(
            'title'=>'Forgot Password | ',
            'validation' => null
        );

        return view('backend/pages/auth/forgot',$data);
    }

    public function sendPasswordResetLink() {
        $isValid = $this->validate([
            'email'=>[
                'rules'=>'required|valid_email|is_not_unique[user.email]',
                'errors'=>[
                    'required'=>'Email is required',
                    'valid_email'=>'Invalid email',
                    'is_not_unique'=>"Email doesn't exists in the system"
                ]
            ]
        ]);

        if(!$isValid) {
            return view('backend/pages/auth/forgot',[
                'title' => 'Forgot Password |',
                'validation'=>$this->validator
            ]);
        } else {
            $user = new User();
            $user_info = $user->asObject()->where('Email',$this->request->getVar('email'))->first();

            $token = bin2hex(openssl_random_pseudo_bytes(65));

            $password_reset_token = new PasswordResetToken();
            $isOldTokenExists = $password_reset_token->asObject()->where('Email',$user_info->Email)->first();

            if($isOldTokenExists) {
                $password_reset_token->where('email',$user_info->Email)
                                     ->set(['token'=>$token,'created_at'=>Carbon::now()])
                                     ->update();
            } else {
                $password_reset_token->insert([
                    'email'=>$user_info->Email,
                    'token'=>$token,
                    'created_at'=>Carbon::now()
                ]);
            }

            // $actionLink = route_to('admin.reset-password', $token);
            $actionLink = base_url(route_to('admin.reset-password', $token));

            $mail_data = array(
                'actionLink'=>$actionLink,
                'user'=>$user_info
            );

            $view = \Config\Services::renderer();
            $mail_body = $view->setVar('mail_data', $mail_data)->render('email-templates/forgot-email-template');

            $mailConfig = array(
                'mail_from_email'=>env('EMAIL_FROM_ADDRESS'),
                'mail_from_name'=>env('EMAIL_FROM_NAME'),
                'mail_recipient_email'=>$user_info->Email,
                'mail_recipient_name'=>$user_info->Last_Name,
                'mail_subject'=>'Reset Password',
                'mail_body'=>$mail_body
            );

            $mail = \Config\Services::email();
            $mail->setFrom('destrezajayr12@gmail.com');
            $mail->setTo($user_info->Email);
            $mail->setSubject('Reset Password');
            $mail->setMessage($mail_body);
            $mail->send();

            if(sendEmail($mailConfig)) {
                return redirect(base_url('admin.forgot.form'))->with('success', 'Password reset link emailed');
            } else {
                return redirect(base_url('admin.forgot.form'))->with('fail', 'Something went wrong');
            }
        }
    }

    public function resetPassword($token) {
        $passwordResetPassword = new PasswordResetToken();
        $check_token = $passwordResetPassword->asObject()->where('token', $token)->first();

        if(!$check_token) {
            return redirect(base_url('admin.forgot.form'))->with('fail', 'Invalid token, request another');
        } else {
            $diffMins = Carbon::createFromFormat('Y-m-d H:i:s', $check_token->created_at)->diffInMinutes(Carbon::now());

            if($diffMins > 15) {
                return redirect(base_url('admin.forgot.form'))->with('fail', 'Token expired, request another');
            } else {
                return view('backend/pages/auth/reset', [
                    'title' => 'Reset Password |',
                    'validation'=>null,
                    'token'=>$token
                ]);
            }
        }
    }

    public function resetPasswordHandler($token) {
        $isValid = $this->validate([
            'new_password'=>[
                'rules'=>'required|min_length[5]|max_length[20]|IsPasswordStrong[new_password]',
                'errors'=>[
                    'required' => 'New Password is required',
                    'min_length' => 'New password must have at least 5 characters',
                    'max_length' => 'New password must not excess more than 20 characters',
                    'IsPasswordStrong' => 'New password must contains atleast 1 uppercase and a number'
                ]
            ],
            'confirm_new_password' => [
                'rules' => 'required|matches[new_password]',
                'errors' => [
                    'required' => 'Confirmation password is required',
                    'matches' => "Password doesn't match"
                ]
            ]
        ]);

        if(!$isValid) {
            return view('backend/pages/auth/reset', [
                'title' => 'Reset Password |',
                'validation'=>null,
                'token'=>$token
            ]);
        } else {
            $passwordResetPassword = new PasswordResetToken();
            $get_token = $passwordResetPassword->asObject()->where('token', $token)->first();

            $user = new User();
            $user_info = $user->asObject()->where('email', $get_token->email)->first();

            if(!$get_token) {
                return redirect()->back()->with('fail', 'Invalid token')->withInput();
            } else {
                $hashPassword = Hash::make($this->request->getVar('new_password'));
                $update = $this->userModel->modifyUserLog($user_info->Email, $hashPassword);
                
                $mail_data = array(
                    'user'=>$user_info,
                    'new_password'=>$this->request->getVar('new_password')
                );

                $view = \Config\Services::renderer();
                $mail_body = $view->setVar('mail_data', $mail_data)->render('email-templates/password-changed-email-template');

                $mailConfig = array(
                    'mail_from_email'=>env('EMAIL_FROM_ADDRESS'),
                    'mail_from_name'=>env('EMAIL_FROM_NAME'),
                    'mail_recipient_email'=>$user_info->Email,
                    'mail_recipient_name'=>$user_info->Last_Name,
                    'mail_subject'=>'Password Changed',
                    'mail_body'=>$mail_body
                );

                $mail = \Config\Services::email();
                $mail->setFrom('destrezajayr12@gmail.com');
                $mail->setTo($user_info->Email);
                $mail->setSubject('Password Changed');
                $mail->setMessage($mail_body);
                $mail->send();

                if(sendEmail($mailConfig)) {
                    $passwordResetPassword->where('email', $user_info->Email)->delete();

                    return redirect(base_url('admin.login.form'))->with('success', 'Your password has be changed');
                } else {
                    return redirect()->back()->with('fail','Something went wrong')->withInput();
                }
            }
        }
    }

    // register
    public function registrationForm() {
        return view('backend/pages/auth/register', ['title' => 'Register |']);
    }

    public function addUser() {
        $req = \Config\Services::request();
        $valid = \Config\Services::validation();

        if ($req->isAJAX()) {
            $this->validate([
                'firstname' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Firstname is required!'
                    ]
                ], 'lastname' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Lastname is required!',
                    ]
                ],'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Email is required.',
                        'valid_email' => 'Please enter a valid email address.',
                    ]
                ],'contact' => [
                    'rules' => 'required|numeric|regex_match[/^[0-9]{11}$/]',
                    'errors' => [
                        'required' => 'Contact number is required.',
                        'numeric' => 'Contact number must be numeric.',
                        'regex_match' => 'Please enter a valid 11-digit contact number.'
                    ]
                ],'username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Username is required!'
                    ]
                ],'password' => [
                    'rules' => 'required|min_length[5]|max_length[20]|IsPasswordStrong[new_password]',
                    'errors' => [
                        'required' => 'Password is required.',
                        'min_length' => 'Password must have at least 5 characters.',
                        'max_length' => 'Password must not excess more than 20 characters.',
                        'IsPasswordStrong' => 'Password must contains atleast 1 uppercase and a number.'
                    ],
                ]
            ]);
        }

        if ($valid->run() == FALSE) {
            $errors = $valid->getErrors();
            return json_encode(['status' => 0, 'error' => $errors]);
        } else {
            $firstname = $req->getVar('firstname');
            $lastname = $req->getVar('lastname');
            $email = $req->getVar('email');
            $contact = $req->getVar('contact');
            $username = $req->getVar('username');
            $password = $req->getVar('password');
            $password = password_hash($password, PASSWORD_BCRYPT);

            $affectedRows = $this->userModel->addUser($firstname, $lastname, $email, $contact, $username, $password);

            if ($affectedRows) {
                return json_encode(['status' => 1]);
            } else {
                return json_encode(['status' => 0]);
            }
        }
    }
}
