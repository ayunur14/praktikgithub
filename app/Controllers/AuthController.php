<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function login()
    {
        helper(['form']);
        return view('auth/login');
    }

    public function authenticate()
    {
        $session = session();
        $model = new UserModel();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $model->where('email', $email)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $sessionData = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'role_id' => $user['role_id'],
                    'logged_in' => TRUE,
                ];
                $session->set($sessionData);
                return redirect()->to('/dashboard');
            } else {
                $session->setFlashdata('error', 'Password is incorrect');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('error', 'Email not found');
            return redirect()->to('/login');
        }
    }
    public function register()
    {
        helper(['form']);
        return view('auth/register');
    }

    public function store()
    {
        helper(['form', 'url']);
        $model = new UserModel();

        $rules = [
            'name' => 'required|min_length[3]|max_length[50]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'password_confirm' => 'matches[password]',
        ];

        if ($this->validate($rules)) {
            $data = [
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'role_id' => 2,
            ];
            $model->save($data);
            return redirect()->to('/login');
        } else {
            return view('auth/register', [
                'validation' => $this->validator,
            ]);
        }
    }


    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}