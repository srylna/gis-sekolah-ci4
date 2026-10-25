<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Jenjang extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Jenjang',
            'menu'  => 'jenjang', // variabel menu aktiv
            'page' => 'v_jenjang',
        ];
        return view('v_template_back_end', $data);
    }
}
