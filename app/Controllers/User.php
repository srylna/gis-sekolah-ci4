<?php

namespace App\Controllers;

use App\Models\ModelUser;

class User extends BaseController
{
    protected $ModelUser;

    public function __construct()
    {
        $this->ModelUser = new ModelUser();
    }

    public function index()
    {
        $data = [
            'title' => 'User',
            'menu'  => 'user',
            'page'  => 'user/v_index',
            'user'  => $this->ModelUser->allData(),
        ];
        return view('v_template_back_end', $data);
    }

    public function Input()
    {
        $data = [
            'title' => 'Tambah User',
            'menu'  => 'user',
            'page'  => 'user/v_input',
        ];
        return view('v_template_back_end', $data);
    }

    public function insertData()
    {
        $foto = $this->request->getFile('foto');
        if ($foto->getError() == 4) {
            $nama_foto = '';
        } else {
            $nama_foto = $foto->getRandomName();
            $foto->move('foto_user', $nama_foto);
        }

        $data = [
            'nama_user' => $this->request->getPost('nama_user'),
            'email'     => $this->request->getPost('email'),
            'password'  => $this->request->getPost('password'),
            'foto'      => $nama_foto,
        ];

        $this->ModelUser->addData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan !!');
        return redirect()->to(base_url('User'));
    }

    public function Edit($id_user)
    {
        $data = [
            'title' => 'Edit User',
            'menu'  => 'user',
            'page'  => 'user/v_edit',
            'user'  => $this->ModelUser->detailData($id_user),
        ];
        return view('v_template_back_end', $data);
    }

    public function updateData($id_user)
    {
        $foto = $this->request->getFile('foto');
        if ($foto->getError() == 4) {
            $nama_foto = $this->request->getPost('foto_lama');
        } else {
            $user = $this->ModelUser->detailData($id_user);
            if (!empty($user['foto']) && file_exists('foto_user/' . $user['foto'])) {
                unlink('foto_user/' . $user['foto']);
            }
            $nama_foto = $foto->getRandomName();
            $foto->move('foto_user', $nama_foto);
        }

        $data = [
            'id_user'   => $id_user,
            'nama_user' => $this->request->getPost('nama_user'),
            'email'     => $this->request->getPost('email'),
            'password'  => $this->request->getPost('password'),
            'foto'      => $nama_foto,
        ];

        $this->ModelUser->editData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diupdate !!');
        return redirect()->to(base_url('User'));
    }

    public function deleteData($id_user)
    {
        $user = $this->ModelUser->detailData($id_user);
        if (!empty($user['foto']) && file_exists('foto_user/' . $user['foto'])) {
            unlink('foto_user/' . $user['foto']);
        }

        $data = ['id_user' => $id_user];
        $this->ModelUser->deleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Didelete !!');
        return redirect()->to(base_url('User'));
    }
}