<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelWilayah;
use App\Models\ModelSetting;
    
class Wilayah extends BaseController
{
     public function __construct()
    {
        $this->ModelWilayah = new ModelWilayah();
        $this->ModelSetting = new ModelSetting();
    }

    public function index(): string
    {
        $data = [
            'title' => 'Wilayah',
            'menu'  => 'wilayah',
            'page' => 'wilayah/v_index',
            'wilayah' => $this->ModelWilayah->Alldata(),
            'web' => $this->ModelSetting->Dataweb(),
        ];
        return view('v_template_back_end', $data);
    }

    public function Input()
    {
         $data = [
            'title' => ' Input Wilayah',
            'menu'  => 'wilayah',
            'page' => 'wilayah/v_input',
        ];
        return view('v_template_back_end', $data);
    }

    public function InsertData() 
    {
        if ($this->validate([
            'nama_wilayah' => [
                'label' => 'Nama Wilayah',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!!'
                ]
            ],
             'geojson' => [
                'label' => 'Data GeoJSON',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!!'
                ]
            ],
            'warna' => [
                'label' => 'Warna',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!!'
                ]
            ],
        ])) {
          // jika validasi berhasil
          $data = [
            'nama_wilayah' => $this->request->getPost('nama_wilayah'),
            'warna' => $this->request->getPost('warna'),
            'geojson' => $this->request->getPost('geojson'),
          ];
          $this->modelWilayah->InsertData($data);
          session()->setFlashdata('insert', 'Data berhasil ditambahkan.');
          return redirect()->to('wilayah');
        } else {
          // jika validasi gagal
          session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('wilayah/input')->withInput('validation', \Config\Services::validation());
        }
    }

    public function Edit($id_wilayah)
    {
        $data = [
            'title' => 'Edit Wilayah',
            'menu'  => 'wilayah',
            'page' => 'wilayah/v_edit',
            'wilayah' => $this->modelWilayah->DetailData($id_wilayah),
        ];
        return view('v_template_back_end', $data);
    }

    public function UpdateData($id_wilayah) 
    {
        if ($this->validate([
            'nama_wilayah' => [
                'label' => 'Nama Wilayah',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!!'
                ]
            ],
             'geojson' => [
                'label' => 'Data GeoJSON',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!!'
                ]
            ],
            'warna' => [
                'label' => 'Warna',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!!'
                ]
            ],
        ])) {
          // jika validasi berhasil
          $data = [
            'id_wilayah' => $id_wilayah,
            'nama_wilayah' => $this->request->getPost('nama_wilayah'),
            'warna' => $this->request->getPost('warna'),
            'geojson' => $this->request->getPost('geojson'),
          ];
          $this->modelWilayah->UpdateData($data);
          session()->setFlashdata('update', 'Data berhasil diupdate.');
          return redirect()->to('wilayah');
        } else {
          // jika validasi gagal
          session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('wilayah/input')->withInput('validation', \Config\Services::validation());
        }
    }

    public function Delete($id_wilayah)
    {
        $data = [
            'id_wilayah' => $id_wilayah,
        ];
        $this->modelWilayah->DeleteData($data);
        session()->setFlashdata('delete', 'Data berhasil dihapus.');
        return redirect()->to('wilayah');
    }
}
