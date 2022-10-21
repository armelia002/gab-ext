<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mmahasiswa extends CI_Model {

	function ambil_data()
    {
        $this -> db->select("id AS id_mhs, 
        npm AS npm_mhs, 
        nama AS nama_mhs, 
        telepon AS telepon_mhs, 
        jurusan AS jurusan_mhs");


        $this ->db ->from("tb_mahasiswa");
        $this ->db ->order_by("npm");

        $query = $this ->db->get() ->result();

        return $query;

    }

    // buat fungsi untuk hapus data
    function hapus_data($token)
    {
        //  cek apakah npm tersedia/tidak
        $this->db->select("npm");
        $this->db->from("tb_mahasiswa");
        $this->db->where("TO_BASE64(npm) = '$token'");
        $query = $this->db->get()->result();

        // jika npm ditemukan
        if (count($query) == 1)
        {
            // hapus data
            $this->db->where("TO_BASE64(npm) = '$token'");
            $this->db->delete("tb_mahasiswa");
            $hasil = 1;
        }
         // jika npm tidak ditemukan
        else
        {
            $hasil = 0;
        }
        // kirim nilai $hasil ke "controller" Mahasiswa
        return $hasil;
    }

    // buat fungsi simpan data
    function simpan_data($npm, $nama, $telepon, $jurusan, $token)
    {
         //  cek apakah npm tersedia/tidak
         $this->db->select("npm");
         $this->db->from("tb_mahasiswa");
         $this->db->where("TO_BASE64(npm) = '$token'");
         $query = $this->db->get()->result();
 
         // jika npm ditemukan
         if (count($query) == 0)
         {
            //  isi data untuk disimpan
            $data = array(
                "npm" => $npm,
                "nama" => $nama,
                "telepon" => $telepon,
                "jurusan" => $jurusan,
              );
            //    simpan data
            $this->db->insert("tb_Mahasiswa", $data);
            $hasil = 0;
        
         }
         else
         {
            $hasil = 1;
         }

         return $hasil;
    }
}
