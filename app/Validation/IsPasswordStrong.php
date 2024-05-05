<?php

namespace App\Validation;

class IsPasswordStrong
{
    public function isPasswordStrong($pass): bool
    {
        $pass = trim($pass);
        if(!preg_match('/^(?=.*[A-Z])(?=.*[0-9]).{5,20}$/',$pass)){
            return false;
        }
        return true;
    }
}
