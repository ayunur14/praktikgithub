<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function login()
    {
        return view('login');  // Akan mencari file 'login.php' di folder app/Views
    }

    public function profile()
    {
        return view('profile'); // Akan mencari file 'profile.php' di folder app/Views
    }
}
