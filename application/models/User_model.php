<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    
    function getCurrLoc($kode) {
        $query = "SELECT alamat FROM customer WHERE kode = '".$kode."' ";
        $data = $this->db->query($query);
        $result = $data->result_array();
        return $result;
    }
    
    function listPelanggan() {
        $query = "SELECT * FROM customer ORDER BY KODE DESC";
        $data = $this->db->query($query);
        $result = $data->result_array();
        return $result;
    }
    
    function getCustinfo($kode) {
        $query = "SELECT * FROM customer WHERE KODE = '".$kode."'";
        $data = $this->db->query($query);
        $result = $data->result_array();
        return $result;
    }
    
    function listDriver() {
        $query = "SELECT * FROM driver ORDER BY KODE DESC";
        $data = $this->db->query($query);
        $result = $data->result_array();
        return $result;
    }
    
    function getDriverinfo($kode) {
        $query = "SELECT * FROM driver WHERE KODE = '".$kode."' ";
        $data = $this->db->query($query);
        $result = $data->result_array();
        return $result;
    }

}