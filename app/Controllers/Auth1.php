<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function register()
    {
        // Aturan validasi
        $rules = [
            'name' => 'required|trim',
            'email' => [
                'rules' => 'required|trim|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email harus diisi.',
                    'valid_email' => 'Format email tidak valid.',
                    'is_unique' => 'Email ini sudah terdaftar.',
                ],
            ],
            'password1' => [
                'rules' => 'required|trim|min_length[8]|matches[password2]',
                'errors' => [
                    'required' => 'Password harus diisi.',
                    'min_length' => 'Password terlalu pendek.',
                    'matches' => 'Password tidak cocok.',
                ],
            ],
            'password2' => 'required|trim|matches[password1]',
        ];

        if ($this->request->getMethod() == 'post') {
            if ($this->validate($rules)) {
                // Jika validasi berhasil
                // Lakukan proses registrasi, seperti menyimpan ke database

                // Redirect ke halaman login
                return redirect()->to('/auth/login');
            } else {
                // Jika validasi gagal, kirimkan pesan kesalahan
                $data['validation'] = $this->validator;
                return view('auth/register', $data);
            }
        }

        return view('auth/register');
    }

    public function login()
    {
        // Aturan validasi untuk login
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]',
        ];

        if ($this->request->getMethod() == 'post') {
            if ($this->validate($rules)) {
                // Jika validasi berhasil
                // Proses login di sini, misalnya mengecek ke database

                // Redirect ke halaman dashboard atau lainnya
                return redirect()->to('/dashboard');
            } else {
                // Jika validasi gagal, kirimkan pesan kesalahan
                $data['validation'] = $this->validator;
                return view('auth/login', $data);
            }
        }

        return view('auth/login');
    }
}
