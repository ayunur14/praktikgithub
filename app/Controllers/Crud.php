<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class crud extends BaseController
{
    public function index()
    {
        // if (!session()->get('isLoggedIn')) {
        //     return redirect()->to('/login');
        // }
        
     // Mengarahkan langsung ke 'Layout/Content'
        return view('Layout/crud'); 
    }
}
