<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan_model extends CI_Model
{

    function getKodePesan()
    {
        $query = 'SELECT kode FROM pesanan ORDER BY kode DESC LIMIT 1';
        $data = $this->db->query($query);
        $result = $data->result_array();
        return $result;
    }

    function getKdPengiriman($kode)
    {
        $query = "SELECT * FROM jns_jasa WHERE kode = '" . $kode . "' ";
        $data = $this->db->query($query);
        $result = $data->row_array();
        return $result;
    }

    function getHrgSat()
    {
        $query = "SELECT * FROM harga_satuan WHERE satuan = 'KG' ";
        $data = $this->db->query($query);
        $result = $data->row_array();
        return $result;
    }

    function insertPesanan($pesanDetail)
    {
        $arrkeys = '';
        $arrvalues = '';
        foreach ($pesanDetail as $keys => $values) {
            $arrkeys .= "`" . $keys . "`" . ",";
            $arrvalues .= "'" . $values . "',";
        }
        $arrkeys = substr($arrkeys, 0, strlen($arrkeys) - 1);
        $arrvalues = substr($arrvalues, 0, strlen($arrvalues) - 1);
        $qry = "INSERT INTO pesanan (" . $arrkeys . ") VALUES (" . $arrvalues . ")";
        $query = $this->db->query($qry);
        return $query;
    }

    function pesananSaya($kodecust)
    {
        $qry = "SELECT p.*, jasa.jenis as jasa, jasa.harga as ongkos FROM pesanan p
                JOIN jns_jasa  AS jasa ON jasa.kode = p.jns_jasa
                WHERE p.kode_customer = " . $kodecust;
        $data = $this->db->query($qry)->result_array();
        return $data;
    }

    function rPesananSaya($kodecust)
    {
        $qry = "SELECT p.*, jasa.jenis as jasa, jasa.harga as ongkos FROM pesanan p
                JOIN jns_jasa  AS jasa ON jasa.kode = p.jns_jasa
                WHERE p.kode_customer = " . $kodecust . " AND p.status = 'S'";
        $data = $this->db->query($qry)->result_array();
        return $data;
    }

    function pesananInfo($kode)
    {
        $qry = "SELECT p.*, jasa.jenis as jasa, jasa.harga as ongkos, c.nama AS customer, c.alamat AS alamatc, c.no_telp, 
                d.nama AS driver FROM pesanan p
                JOIN driver AS d ON d.kode = p.driver
                JOIN customer AS c ON c.kode = p.kode_customer
                JOIN jns_jasa AS jasa ON jasa.kode = p.jns_jasa
                WHERE p.kode = '" . $kode . "' ";
        $data = $this->db->query($qry)->result_array();
        return $data;
    }

    function getPesananList($status = ' ')
    {
        $query = "SELECT p.*, jasa.jenis as jasa, jasa.harga as ongkos, c.nama AS nama_cust
                    FROM pesanan p
                    JOIN jns_jasa  AS jasa ON jasa.kode = p.jns_jasa
                    JOIN customer  AS c ON c.kode = p.kode_customer
                    WHERE p.`status` = '" . $status . "' 
                    ORDER BY p.`kode` DESC";
        $data = $this->db->query($query);
        $result = $data->result_array();
        return $result;
    }

    function getPesananDriver($kode)
    {
        $query = "SELECT p.*, jasa.jenis as jasa, jasa.harga as ongkos, c.nama AS nama_cust
                    FROM pesanan p
                    JOIN jns_jasa  AS jasa ON jasa.kode = p.jns_jasa
                    JOIN customer  AS c ON c.kode = p.kode_customer
                    WHERE p.`driver` = '" . $kode . "' 
                    ORDER BY p.`kode` DESC LIMIT 2";
        $data = $this->db->query($query);
        $result = $data->result_array();
        return $result;
    }

    function getPesananListAcc()
    {
        $status = '';
        $query = "SELECT p.*, jasa.jenis as jasa, jasa.harga as ongkos, c.nama AS nama_cust
                    FROM pesanan p
                    JOIN jns_jasa  AS jasa ON jasa.kode = p.jns_jasa
                    JOIN customer  AS c ON c.kode = p.kode_customer
                    WHERE p.`status` <> '" . $status . "' 
                    ORDER BY p.`kode` DESC";
        $data = $this->db->query($query);
        $result = $data->result_array();
        return $result;
    }

    function getPesananD($kode)
    {
        $query = "SELECT p.*, jasa.jenis as jasa, jasa.harga as ongkos, c.nama AS nama_cust
                    FROM pesanan p
                    JOIN jns_jasa  AS jasa ON jasa.kode = p.jns_jasa
                    JOIN customer  AS c ON c.kode = p.kode_customer
                    WHERE p.`driver` = '" . $kode . "' ";
        $data = $this->db->query($query);
        $result = $data->result_array();
        return $result;
    }

    function getPesananDt($kode)
    {
        $query = "SELECT p.*, jasa.jenis as jasa, jasa.harga as ongkos, c.nama AS nama_cust
                    FROM pesanan p
                    JOIN jns_jasa  AS jasa ON jasa.kode = p.jns_jasa
                    JOIN customer  AS c ON c.kode = p.kode_customer
                    WHERE p.`driver` = '" . $kode . "' AND p.`status` = 'D' ";
        $data = $this->db->query($query);
        $result = $data->result_array();
        return $result;
    }
}
