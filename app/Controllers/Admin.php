<?php

namespace App\Controllers;

use App\Models\ModelSetting;
use App\Models\ModelSekolah; 
use App\Models\ModelWilayah;

class Admin extends BaseController
{
    protected $ModelSetting;
    protected $ModelSekolah; // 3. Deklarasi Properti
    protected $ModelWilayah;

    public function __construct()
    {
        $this->ModelSetting = new ModelSetting();
        $this->ModelSekolah = new ModelSekolah(); // 4. Inisialisasi Properti
        $this->ModelWilayah = new ModelWilayah();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'menu'  => 'dashboard',
            'page' => 'v_dashboard',
            // 5. Kirim data yang dibutuhkan Leaflet.js di v_dashboard.php
            'setting' => $this->ModelSetting->Dataweb(),
            'sekolah' => $this->ModelSekolah->allData(),
            'wilayah' => $this->ModelWilayah->allData(),
        ];
        return view('v_template_back_end', $data);
    }
    
    public function Setting()
    {
        $data = [
            'title' => 'Setting',
            'menu'  => 'setting',
            'page' => 'v_setting',
            'web' => $this->ModelSetting->Dataweb(),
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
