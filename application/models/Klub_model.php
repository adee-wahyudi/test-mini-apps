<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Klub_model extends CI_Model {

    public function getAll()
    {
        return $this->db->get('klub')->result_array();
    }

    public function addKlub($nama_klub, $kota)
    {
        $data = [
            'nama_klub' => $nama_klub,
            'kota' => $kota
        ];
        $this->db->insert('klub', $data);
    }

    public function getKlub($nama_klub)
    {
        return $this->db->get_where('klub', ['nama_klub' => $nama_klub])->row_array();
    }

    public function delete($id)
    {
        $this->db->delete('klub', ['id' => $id]);
    }
}