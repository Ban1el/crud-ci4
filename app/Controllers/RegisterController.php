<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class RegisterController extends BaseController
{

    protected $user_model;

    public function __construct()
    {
        $this->user_model = new UserModel();
    }

    public function index()
    {
        helper('form');
        $data = [
            'title' => 'Register User',
        ];
        return view("students/register",  $data);
    }

    public function register_user()
    {
        helper('form');

        $rules = [
            'username' => 'required|is_unique[users.user_username]',
            'name' => 'required',
            'email' => 'required|valid_email|is_unique[users.user_email]',
            'mobile' => 'required',
            'password' => 'required',
            'conf-password' => 'required|matches[password]'
        ];

        if (!$this->validate($rules)) {

            $data = [
                'title' => 'Register User',
                'validation' => $this->validator,
            ];

            return view("students/register", $data);
        } else {

            $password = $this->request->getPost('password');
            $hashed_password = password_hash(strval($password), PASSWORD_DEFAULT);

            $inputData = [
                'user_id' => $this->user_model->generate_user_id(),
                'user_username' => $this->request->getPost('username'),
                'user_name' => $this->request->getPost('name'),
                'user_email' => $this->request->getPost('email'),
                'user_mobile' => $this->request->getPost('mobile'),
                'user_password' => $hashed_password,
            ];

            $this->user_model->insert($inputData);

            return redirect('register')->with('status', 'User added!');
        }
    }
}
