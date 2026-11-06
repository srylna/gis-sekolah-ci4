<?php

namespace App\Controllers;

use App\Models\ModelSekolah;
use App\Models\ModelSetting;
use App\Models\ModelWilayah;

class Home extends BaseController
{   
     public function __construct()
    {
        $this->ModelSetting = new ModelSetting();
        $this->ModelSekolah = new ModelSekolah(); // 4. Inisialisasi Properti
        $this->ModelWilayah = new ModelWilayah();
    }

    public function index()
    {
        $data = [
            'title' => 'Home',
            'page' => 'v_home',
            'web' => $this->ModelSetting->Dataweb(),
            'setting' => $this->ModelSetting->Dataweb(),
            'sekolah' => $this->ModelSekolah->allData(),
            'wilayah' => $this->ModelWilayah->Alldata(),
        ];
        return view('v_template_front_end', $data);
    }
}
