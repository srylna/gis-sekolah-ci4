<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Sekolah extends BaseController
{
    public function index()
    {
         $data = [
            'title' => 'Sekolah',
            'menu'  => 'sekolah',
            'page' => 'v_sekolah',
        ];
        return view('v_template_back_end', $data);
    }
}
