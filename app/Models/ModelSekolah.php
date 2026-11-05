<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSekolah extends Model
{
    public function Alldata()
    {
        return $this->db->table('tbl_sekolah')
        ->join('tbl_jenjang', 'tbl_jenjang.id_jenjang = tbl_sekolah.id_jenjang', 'left')
        ->get()->getResultArray();
    }

    public function InsertData($data)
    {
        $this->db->table('tbl_sekolah')->insert($data);
    }

    public function DetailData($id_sekolah)
    {
        return $this->db->table('tbl_sekolah')
         ->join('tbl_jenjang', 'tbl_jenjang.id_jenjang = tbl_sekolah.id_jenjang', 'left')
         ->join('tbl_kabupaten', 'tbl_kabupaten.id_kabupaten = tbl_sekolah.id_kabupaten', 'left')
         ->join('tbl_kecamatan', 'tbl_kecamatan.id_kecamatan = tbl_sekolah.id_kecamatan', 'left')
        ->where('id_sekolah', $id_sekolah)
        ->get()->getRowArray();
    }

    public function UpdateData($data)
    {
        $this->db->table('tbl_sekolah')
        ->where('id_sekolah', $data['id_sekolah'])
        ->update($data);
    }

    public function DeleteData($data)
    {
        $this->db->table('tbl_sekolah')
        ->where('id_sekolah', $data['id_sekolah'])
        ->delete($data);
    }

    // provinsi
    public function allProvinsi()
    {
        return $this->db->table('tbl_provinsi')
        ->orderBy('nama_provinsi', 'ASC')
        ->get()
        ->getResultArray();
    }

    // Ambil Kabupaten berdasarkan ID Provinsi
    public function getKabupaten($id_provinsi)
    {
        return $this->db->table('tbl_kabupaten')
                        ->where('id_provinsi', $id_provinsi)
                        ->orderBy('nama_kabupaten', 'ASC')
                        ->get()
                        ->getResultArray();
    }

    // Ambil Kecamatan berdasarkan ID Kabupaten
    public function getKecamatan($id_kabupaten)
    {
        return $this->db->table('tbl_kecamatan')
                        ->where('id_kabupaten', $id_kabupaten)
                        ->orderBy('nama_kecamatan', 'ASC')
                        ->get()
                        ->getResultArray();
    }

    // Wilayah Administrasi
    public function allWilayah()
    {
        return $this->db->table('tbl_wilayah')
                        ->orderBy('nama_wilayah', 'ASC')
                        ->get()
                        ->getResultArray();
    }
}
