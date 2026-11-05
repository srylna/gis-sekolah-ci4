<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelWilayah;
use App\Models\ModelSetting;
use App\Models\ModelSekolah;
use App\Models\ModelJenjang;


class Sekolah extends BaseController
{   
    public function __construct()
    {
        $this->ModelWilayah = new ModelWilayah();
        $this->ModelSetting = new ModelSetting();
        $this->ModelSekolah = new ModelSekolah();
        $this->ModelJenjang = new ModelJenjang();
    }

    public function index()
    {
         $data = [
            'title' => 'Sekolah',
            'menu'  => 'sekolah',
            'page'  => 'sekolah/v_index',
            'sekolah' => $this->ModelSekolah->Alldata(),
        ];
        return view('v_template_back_end', $data);
    }

    public function Input()
    {
         $data = [
            'title' => 'Input Sekolah',
            'menu'  => 'sekolah',
            'page' => 'sekolah/v_input',
            'web' => $this->ModelSetting->Dataweb(),
            'provinsi' => $this->ModelSekolah->allProvinsi(),
            'wilayah' => $this->ModelWilayah->Alldata(),
            'jenjang' => $this->ModelJenjang->Alldata(),
        ];
        return view('v_template_back_end', $data);
    }
    
    public function InsertData() 
    {
        if ($this->validate([
            'nama_sekolah' => [
                'label' => 'Nama Sekolah',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!!'
                ]
            ],
             'akreditasi' => [
                'label' => 'Akreditasi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!!'
                ]
            ],
            'status' => [
                'label' => 'Status',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!!'
                ]
            ],
            'id_jenjang' => [
                'label' => 'Jenjang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!!'
                ]
            ],
            'coordinat' => [
                'label' => 'Coordinat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!!'
                ]
            ],
            'id_provinsi' => [
                'label' => 'Provinsi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!!'
                ]
            ],
            'id_kabupaten' => [
                'label' => 'Kabupaten',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!!'
                ]
            ],
            'id_kecamatan' => [
                'label' => 'Kecamatan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!!'
                ]
            ],
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!!'
                ]
            ],
            'id_wilayah' => [
                'label' => 'Wilayah Administrasi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!!'
                ]
            ],
          'foto' => [
            'label'  => 'Foto',
            'rules'  => 'uploaded[foto]|ext_in[foto,jpg,jpeg,png,JPG,JPEG,PNG]',
            'errors' => [
                'uploaded' => '{field} Wajib Diunggah !!!',
                'ext_in'   => 'Format {field} Wajib .JPG, .JPEG, .PNG !!!',
            ]
        ],
        ])) {
            $foto =$this->request->getFile('foto');
            $nama_file_foto = $foto->getRandomName();



          // jika validasi berhasil
          $data = [
            'nama_sekolah' => $this->request->getPost('nama_sekolah'),
            'akreditasi' => $this->request->getPost('akreditasi'),
            'status' => $this->request->getPost('status'),
            'coordinat' => $this->request->getPost('coordinat'),
            'id_jenjang' => $this->request->getPost('id_jenjang'),
            'id_provinsi' => $this->request->getPost('id_provinsi'),
            'id_kabupaten' => $this->request->getPost('id_kabupaten'),
            'id_kecamatan' => $this->request->getPost('id_kecamatan'),
            'alamat' => $this->request->getPost('alamat'),
            'id_wilayah' => $this->request->getPost('id_wilayah'),
            'foto' => $nama_file_foto,
          ];
          $foto->move('foto', $nama_file_foto);
          $this->ModelSekolah->InsertData($data);
          session()->setFlashdata('insert', 'Data berhasil ditambahkan.');
          return redirect()->to('Sekolah');
        } else {
          // jika validasi gagal
          session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('Sekolah/Input')->withInput('validation', \Config\Services::validation());
        }
    }

     public function Edit($id_sekolah)
    {
         $data = [
            'title' => 'Edit Sekolah',
            'menu'  => 'sekolah',
            'page' => 'sekolah/v_edit',
            'web' => $this->ModelSetting->Dataweb(),
            'provinsi' => $this->ModelSekolah->allProvinsi(),
            'wilayah' => $this->ModelWilayah->Alldata(),
            'jenjang' => $this->ModelJenjang->Alldata(),
            'sekolah' => $this->ModelSekolah->DetailData($id_sekolah),
        ];
        return view('v_template_back_end', $data);
    }

    public function UpdateData($id_sekolah) 
    {
        if ($this->validate([
            'nama_sekolah' => [
                'label' => 'Nama Sekolah',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!!'
                ]
            ],
             'akreditasi' => [
                'label' => 'Akreditasi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!!'
                ]
            ],
            'status' => [
                'label' => 'Status',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!!'
                ]
            ],
            'id_jenjang' => [
                'label' => 'Jenjang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!!'
                ]
            ],
            'coordinat' => [
                'label' => 'Coordinat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!!'
                ]
            ],
            'id_provinsi' => [
                'label' => 'Provinsi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!!'
                ]
            ],
            'id_kabupaten' => [
                'label' => 'Kabupaten',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!!'
                ]
            ],
            'id_kecamatan' => [
                'label' => 'Kecamatan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!!'
                ]
            ],
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!!'
                ]
            ],
            'id_wilayah' => [
                'label' => 'Wilayah Administrasi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!!'
                ]
            ],
          'foto' => [
            'label'  => 'Foto',
            'rules'  => 'ext_in[foto,jpg,jpeg,png,JPG,JPEG,PNG]',
            'errors' => [
                'uploaded' => '{field} Wajib Diunggah !!!',
                'ext_in'   => 'Format {field} Wajib .JPG, .JPEG, .PNG !!!',
            ]
        ],
        ])) {
          // JIKA VALIDASI BERHASIL
            $sekolah = $this->ModelSekolah->detailData($id_sekolah);
            $foto = $this->request->getFile('foto');

            if ($foto->getError() == 4) {
                // Jika foto TIDAK diganti
                $nama_file_foto = $sekolah['foto'];
            } else {
                // Jika foto DIGANTI
                $nama_file_foto = $foto->getRandomName();
                $foto->move('foto', $nama_file_foto);

                // Hapus foto lama jika ada di folder
                if ($sekolah['foto'] != "" && file_exists('foto/' . $sekolah['foto'])) {
                    unlink('foto/' . $sekolah['foto']);
                }
            }

          // jika validasi berhasil
          $data = [
            'id_sekolah' => $id_sekolah,
            'nama_sekolah' => $this->request->getPost('nama_sekolah'),
            'akreditasi' => $this->request->getPost('akreditasi'),
            'status' => $this->request->getPost('status'),
            'coordinat' => $this->request->getPost('coordinat'),
            'id_jenjang' => $this->request->getPost('id_jenjang'),
            'id_provinsi' => $this->request->getPost('id_provinsi'),
            'id_kabupaten' => $this->request->getPost('id_kabupaten'),
            'id_kecamatan' => $this->request->getPost('id_kecamatan'),
            'alamat' => $this->request->getPost('alamat'),
            'id_wilayah' => $this->request->getPost('id_wilayah'),
            'foto' => $nama_file_foto,
          ];

          $this->ModelSekolah->UpdateData($data);
          session()->setFlashdata('update', 'Data berhasil diupdate.');
          return redirect()->to('Sekolah');
        } else {
          // jika validasi gagal
          session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('Sekolah/Edit/' . $id_sekolah)->withInput('validation', \Config\Services::validation());
        }
    }

    // Delete Data
    public function Delete($id_sekolah)
    {
        // delete foto lama jika ada di folder
        $sekolah = $this->ModelSekolah->detailData($id_sekolah);
        if ($sekolah['foto'] <> '') {
            unlink('foto/' . $sekolah['foto']);
        }
        $data = [
            'id_sekolah' => $id_sekolah,
        ];
        $this->ModelSekolah->DeleteData($data);
        session()->setFlashdata('delete', 'Data berhasil dihapus.');
        return redirect()->to('Sekolah');
    }

    public function Detail($id_sekolah)
    {
        $data = [
            'title' => 'Detail Sekolah',
            'menu'  => 'sekolah',
            'page' => 'sekolah/v_detail',
            'web' => $this->ModelSetting->Dataweb(),
            'sekolah' => $this->ModelSekolah->DetailData($id_sekolah),
        ];
        return view('v_template_back_end', $data);
    }   

    // kabupaten, kecamatan
    public function Kabupaten()
    {
        $id_provinsi = $this->request->getPost('id_provinsi');
        $kabupaten = $this->ModelSekolah->getKabupaten($id_provinsi);
        echo '<option value="">--Pilih Kabupaten--</option>';
        foreach ($kabupaten as $key => $value) {
            echo '<option value="' . $value['id_kabupaten'] . '">' . $value['nama_kabupaten'] . '</option>';
        }
    }

    public function Kecamatan()
   {
        $id_kabupaten = $this->request->getPost('id_kabupaten');
        $kecamatan    = $this->ModelSekolah->getKecamatan($id_kabupaten);

        echo '<option value="">--Pilih Kecamatan--</option>';
        foreach ($kecamatan as $value) {
           echo '<option value="' . $value['id_kecamatan'] . '">' . $value['nama_kecamatan'] . '</option>';
        }
    }

}