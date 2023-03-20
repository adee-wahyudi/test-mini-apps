<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skor_model extends CI_Model {

    public function getAll()
    {
        return $this->db->get('pertandingan')->result_array();
    }

    public function getKlub($klub1, $klub2)
    {
        $data = [
            'id_klub1' => $klub1,
            'id_klub2' => $klub2
        ];
        return $this->db->get_where('pertandingan', $data)->row_array();
    }

    public function getAllKlasemen()
    {
        $query = "SELECT `klasemen`.*, `klub`.`nama_klub`
                  FROM `klasemen` 
                  INNER JOIN `klub` 
                  ON `klasemen`.`id_klub` = `klub`.`id`
                  ORDER BY `klasemen`.`point` DESC";
        return $this->db->query($query)->result_array();
    }

    public function getKlasemen1($klub1)
    {
        return $this->db->get_where('klasemen', ['id_klub' => $klub1])->row_array();
    }
    
    public function getKlasemen2($klub2)
    {
        return $this->db->get_where('klasemen', ['id_klub' => $klub2])->row_array();
    }
    
    public function addScore($data)
    {
        $this->db->insert('pertandingan', $data);
    }

    public function addKlasemen1($data1)
    {
        $this->db->insert('klasemen', $data1);
    }

    public function addKlasemen2($data2)
    {
        $this->db->insert('klasemen', $data2);
    }

    public function updateKlasemen1($id1, $data1)
    {
        $this->db->update('klasemen', $data1, ['id' => $id1]);
    }

    public function updateKlasemen2($id2, $data2)
    {
        $this->db->update('klasemen', $data2, ['id' => $id2]);
    }

    // public function deleteScore($id)
    // {
    //     $this->db->delete('pertandingan', ['id' => $id]);
    // }
}