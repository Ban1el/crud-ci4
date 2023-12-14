<?php

namespace App\Validation;

use App\Models\UserModel;

class LoginValidation
{
    public function username_exist($value)
    {
        $user_model = new UserModel();
        return $user_model->where('user_username', $value)->first() !== null;
    }

    public function password_check($value, string $param, array $data, &$error = null)
    {
        $user_model = new UserModel();

        if ($user_model->where('user_username', strval($data['username']))->first() !== null) {

            $user_data = $user_model->where('user_username', strval($data['username']))->first();
            $password = strval($value);
            $hashed_password = $user_data['user_password'];
            $verify_password = password_verify($password, $hashed_password);

            if ($verify_password) {
                return true;
            } else {
                $error = 'Wrong password, please try again';
                return false;
            }
        } else {
            $error = '';
            return false;
        }
    }
}
