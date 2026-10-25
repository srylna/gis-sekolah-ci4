<?php

namespace App\Controllers;

use App\Models\ModelSetting;

class Admin extends BaseController
{

    public function __construct()
    {
        $this->modelSetting = new ModelSetting();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'menu'  => 'dashboard',
            'page' => 'v_dashboard',
        ];
        return view('v_template_back_end', $data);
    }
    
    public function Setting()
    {
        $data = [
            'title' => 'Setting',
            'menu'  => 'setting',
            'page' => 'v_setting',
            'web' => $this->modelSetting->Dataweb(),
        ];
        return view('v_template_back_end', $data);
    }

    public function UpdateSetting()
    {
        $data = [
            'id' => 1,
            'nama_web' => $this->request->getPost('nama_web'),
            'coordinat_wilayah' => $this->request->getPost('coordinat_wilayah'),
            'zoom_view' => $this->request->getPost('zoom_view'),
        ];

       // panggil method UpdateSetting() sesuai dengan yang ada di ModelSetting.php
        $this->modelSetting->UpdateSetting($data);
        session()->setFlashdata('pesan', 'Settingan website telah diupdate !!!');
        return redirect()->to('Admin/Setting');
    }
}
