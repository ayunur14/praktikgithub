<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');  // Akan mencari file 'login.php' di folder app/Views
    }

    public function register()
    {
        return view('auth/register'); // Akan mencari file 'profile.php' di folder app/Views
    }
}
