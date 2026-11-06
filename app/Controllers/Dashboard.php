<?php

namespace App\Controllers;

use App\Models\ModelSekolah;
use App\Models\ModelWilayah;
use App\Models\ModelSetting;

class Home extends BaseController
{
    protected $ModelSekolah;
    protected $ModelWilayah;
    protected $ModelSetting;

    public function __construct()
    {
        $this->ModelSekolah = new ModelSekolah();
        $this->ModelWilayah = new ModelWilayah();
        $this->ModelSetting = new ModelSetting();
    }

    public function index()
    {
        $data = [
            'title'    => 'Dashboard GIS Sekolah',
            'menu'     => 'dashboard',
            'page'     => 'v_dashboard',
            'setting'  => $this->ModelSetting->detailData(),
            'sekolah'  => $this->ModelSekolah->allData(), // Mengambil semua sekolah + koordinat
            'wilayah'  => $this->ModelWilayah->allData(), // Mengambil semua wilayah + geojson/warna
        ];
        return view('v_template_back_end', $data);
    }
}