<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class LoginController extends BaseController
{
    protected $user_model;
    protected $session;

    public function __construct()
    {
        $this->user_model = new UserModel();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $data = [
            'title' => 'Login'
        ];

        return view('students/login', $data);
    }

    public function login_user()
    {
        $rules = [
            'username' => 'required|username_exist',
            'password' => 'required|password_check[username]',
        ];

        $messages = [
            'username' => ['username_exist' => 'User does not exist'],
        ];

        if (!$this->validate($rules, $messages)) {
            //Send validation errors through session
            $validationErrors = $this->validator->getErrors();
            //With Input to keep the old input data from the form, old('input name')
            return redirect()->back()->withInput()->with('validationErrors', $validationErrors);
        } else {
            $username = $this->request->getPost('username');
            $user_data = $this->user_model->where('user_username', $username)->first();
            $user_id = $user_data['user_id'];

            $this->session->set('user_id',  $user_id);

            return redirect('students/dashboard');
        }
    }

    public function logout()
    {
        $this->session->remove('user_id');
        return redirect('login');
    }
}
