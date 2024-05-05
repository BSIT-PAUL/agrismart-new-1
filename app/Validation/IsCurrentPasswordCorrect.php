<?php

namespace App\Validation;
use App\Libraries\CIAuth;
use App\Libraries\Hash;
use App\Models\User;

class IsCurrentPasswordCorrect
{
    public function check_curr_pass($pass): bool
    {

        $pass = trim($pass);
        $user_ID = CIAuth::id();
        $user = new User();
        $userInfo = $user->getUserDetails($user_ID);

        if(!Hash::check($pass, $userInfo->Password)){
            return false;
        }
        return true;
    }
}
