<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelJenjang;

class Jenjang extends BaseController
{
    public function __construct()
    {
        $this->ModelJenjang = new ModelJenjang();
    }
    
    public function index()
    {
        $data = [
            'title' => 'Jenjang',
            'menu'  => 'jenjang', // variabel menu aktiv
            'page' => 'v_jenjang',
            'jenjang' => $this->ModelJenjang->Alldata(),
        ];
        return view('v_template_back_end', $data);
    }

    public function UpdateData($id_jenjang)
    {   
        $marker = $this->request->getFile('marker');
        $nama_file = $marker->getRandomName();
        $data = [
            'id_jenjang' => $id_jenjang,
            'marker' => $nama_file,
        ];
        $marker->move('marker', $nama_file); // simpan file marker ke folder marker
        $this->ModelJenjang->UpdateData($data); // panggil method UpdateData() sesuai dengan yang ada di ModelJenjang.php
        session()->setFlashdata('pesan', 'Marker telah diupdate !!!');
        return redirect()->to('Jenjang');
    }
}
