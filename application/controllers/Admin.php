<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Admin extends BaseController
{

    function mBarang()
    {
        $cekSession = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        if ($cekSession == '') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger py-2" role="alert">Anda belum auth_user.</div>');
            redirect('auth_user');
        }
        $data['dataAdm'] = $cekSession;
        $data['title'] = 'Master Barang';
        $data['active'] = 'Mbarang';

        $this->global['page_title'] = 'Master Barang - Admin Laundry';
        $this->loadViewsAdmin('admin/mbarang', $this->global, $data, NULL, TRUE);
    }

    function addBarang()
    {
        $kode = $this->input->post('kode');
        $nama = $this->input->post('nama');
        $harga = $this->input->post('harga');
        $dataAdd = [
            'kode' => $kode,
            'nama' => $nama,
            'harga' => $harga
        ];
        $res = $this->db->insert('data_barang', $dataAdd);
        
        if ($res) {
            echo json_encode('success');
        } else {
            echo json_encode('error');
        }
    }
    function updateBarang()
    {
        $kode = $this->input->post('kode');
        $nama = $this->input->post('nama');
        $harga = $this->input->post('harga');

        $Update = "UPDATE data_barang SET `nama` = '" . $nama . "', harga = '" . $harga . "' WHERE kode = '" . $kode . "' ";
        $this->db->query($Update);
        echo json_encode('success');
    }

    public function custList()
    {
        $cekSession = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        if ($cekSession == '') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger py-2" role="alert">Anda belum auth_user.</div>');
            redirect('auth_user');
        }
        $data['cust'] = $this->User_model->listPelanggan();
        $data['dataAdm'] = $cekSession;
        $data['title'] = 'Data Pelanggan';
        $data['active'] = 'Pengguna';

        $this->global['page_title'] = 'Data Pelanggan - Admin Laundry';
        $this->loadViewsAdmin('admin/pelanggan', $this->global, $data, NULL, TRUE);
    }

    function getCust() {
        $kode = $this->input->post('kode');
        $custInfo = $this->User_model->getCustinfo($kode);

        echo json_encode($custInfo);
    }
    
    function updateCust() {
        $kode = $this->input->post('kode');
        $status = $this->input->post('status');
        $qryUpdate = "UPDATE customer SET `status` = '".$status."' WHERE kode = '".$kode."'";
        $res = $this->db->query($qryUpdate);
        if ($res == 1) {
            echo json_encode('success');
        } else {
            echo json_encode('error');
        }
    }

    function deleteCust() {
        $kode = $this->input->post('kode');
        $deleteCust = "DELETE FROM customer WHERE kode = '".$kode."'";
        $res = $this->db->query($deleteCust);
        if ($res == 1) {
            echo json_encode('success');
        } else {
            echo json_encode('error');
        }
    }
    
    function deleteBrg() {
        $kode = $this->input->post('kode');
        $deleteCust = "DELETE FROM data_barang WHERE kode = '".$kode."'";
        $res = $this->db->query($deleteCust);
        if ($res == 1) {
            echo json_encode('success');
        } else {
            echo json_encode('error');
        }
    }
    
    public function driverList()
    {
        $cekSession = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        if ($cekSession == '') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger py-2" role="alert">Anda belum auth_user.</div>');
            redirect('auth_user');
        }
        $data['drv'] = $this->User_model->listDriver();
        $data['dataAdm'] = $cekSession;
        $data['title'] = 'Data Driver';
        $data['active'] = 'Pengguna';
        
        $this->global['page_title'] = 'Data Driver - Admin Laundry';
        $this->loadViewsAdmin('admin/driver', $this->global, $data, NULL, TRUE);
    }
    
    function getDriver() {
        $kode = $this->input->post('kode');
        $driverInfo = $this->User_model->getDriverinfo($kode);

        echo json_encode($driverInfo);
    }
    
    function updateDriver() {
        $kode = $this->input->post('kode');
        $status = $this->input->post('status');
        $qryUpdate = "UPDATE driver SET `status` = '".$status."' WHERE kode = '".$kode."'";
        $res = $this->db->query($qryUpdate);
        if ($res == 1) {
            echo json_encode('success');
        } else {
            echo json_encode('error');
        }
    }

    function deleteDriver() {
        $kode = $this->input->post('kode');
        $deleteCust = "DELETE FROM driver WHERE kode = '".$kode."'";
        $res = $this->db->query($deleteCust);
        if ($res == 1) {
            echo json_encode('success');
        } else {
            echo json_encode('error');
        }
    }

    public function pesanan()
    {
        $cekSession = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        if ($cekSession == '') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger py-2" role="alert">Anda belum auth_user.</div>');
            redirect('auth_user');
        }
        $data['pesanan'] = $this->Pesanan_model->getPesananList();
        // print_r($data['pesanan']);
        $data['dataAdm'] = $cekSession;
        $data['title'] = 'Pesanan';
        $data['active'] = 'Pesanan';

        $this->global['page_title'] = 'Pesanan - Admin Laundry';
        $this->loadViewsAdmin('admin/pesanan', $this->global, $data, NULL, TRUE);
    }

    function getPesanInfo()
    {
        $kode = $this->input->post('kode');
        $data['getPesanInfo'] = $this->Pesanan_model->pesananInfo($kode);
        echo json_encode(array('success' => 'berhasil', 'data' => $data));
    }

    function accBooking()
    {
        $kode = $this->input->post('kode');
        $driver = $this->input->post('driver');
        $UpdateFlag = "UPDATE pesanan SET `status` = 'Y', driver = '" . $driver . "' WHERE kode = '" . $kode . "' ";
        $update = $this->db->query($UpdateFlag);
        echo json_encode(array('success' => 'berhasil'));
    }

    function antarPesanan()
    {
        $kode = $this->input->post('kode');
        $driver = $this->input->post('driver');
        $UpStatus = "UPDATE pesanan SET `status` = 'A', driver = '" . $driver . "' WHERE kode = '" . $kode . "' ";
        $update = $this->db->query($UpStatus);
        echo json_encode(array('success' => 'berhasil'));
    }

    function BuktiBayar()
    {
        $kode = $this->input->post('kodePesan');
        $getImg = "SELECT gambar FROM tb_bayar WHERE pesanan = '" . $kode . "' ";
        $data = $this->db->query($getImg)->row_array();
        echo json_encode($data);
    }

    function progresAcc()
    {
        $kode = $this->input->post('kode');
        $status = $this->input->post('status');
        $UpdateFlag = "UPDATE pesanan SET status = '" . $status . "' WHERE kode = '" . $kode . "' ";
        $update = $this->db->query($UpdateFlag);
        echo json_encode(array('success' => 'berhasil'));
    }

    public function Lpesanan()
    {
        $cekSession = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        if ($cekSession == '') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger py-2" role="alert">Anda belum auth_user.</div>');
            redirect('auth_user');
        }
        $data['pesanan'] = $this->Pesanan_model->getPesananListAcc();
        $data['dataAdm'] = $cekSession;
        $data['title'] = 'Laporan Pesanan';
        $data['active'] = 'Laporan';

        $this->global['page_title'] = 'Laporan Pesanan - Admin Laundry';
        $this->loadViewsAdmin('admin/lpesanan', $this->global, $data, NULL, TRUE);
    }

    public function transaksi()
    {
        $cekSession = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        if ($cekSession == '') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger py-2" role="alert">Anda belum auth_user.</div>');
            redirect('auth_user');
        }
        $data['pesanan'] = $this->Pesanan_model->getPesananListAcc();
        $data['dataAdm'] = $cekSession;
        $data['title'] = 'Laporan Transaksi';
        $data['active'] = 'Laporan';

        $this->global['page_title'] = 'Transaksi - Admin Laundry';
        $this->loadViewsAdmin('admin/transaksi', $this->global, $data, NULL, TRUE);
    }

    function laprekap()
    {
        $cekSession = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        if ($cekSession == '') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger py-2" role="alert">Anda belum auth_user.</div>');
            redirect('auth_user');
        }
        $data['dataAdm'] = $cekSession;
        $data['title'] = 'Laporan Rekap Transaksi';
        $data['active'] = 'Laporan';

        $this->global['page_title'] = 'Rekapulasi | Admin Laundry';
        $this->loadViewsAdmin('admin/laprekap', $this->global, $data, NULL, TRUE);
    }

    function getRekap()
    {
        $kode = $this->input->post('kode');
        $status = $this->input->post('status');
        $tgl = $this->input->post('tgl');
        $tgls = $this->input->post('tgls');
        $order = $this->input->post('order');

        $data = [
            'kode' => $kode,
            'status' => $status,
            'tgl' => $tgl,
            'tgls' => $tgls,
            'order' => $order
        ];
        $this->session->set_userdata($data);
        echo json_encode('success');
    }

    function lapRekapView()
    {
        $kode = $this->session->userdata('kode');
        $status = $this->session->userdata('status');
        $tgl = $this->session->userdata('tgl');
        $tgls = $this->session->userdata('tgls');
        $order = $this->session->userdata('order');

        $qryp = '';
        $qrys = '';
        if ($kode != '') {
            $qryp = " AND p.kode = '" . $kode . "' ";
        }
        if ($status != '') {
            $qrys = " AND p.status = '" . $status . " '";
        }

        if ($tgl == '' && $tgls == '') {
            $qrt = '';
        } else {
            $qrt = " p.tanggal BETWEEN '" . $tgl . "' AND '" . $tgls . "' ";
        }

        if ($order == 'kode') {
            $order = 'p.kode';
        } else if ($order == 'nama_pelanggan') {
            $order = 'nama_pelanggan';
        } else if ($order == 'tanggal') {
            $order = 'p.tanggal';
        }

        // if ($kode != '' or $status != '' or $qrt != '') {
            $where = ' WHERE ';
        // } else {
        //     $where = '';
        // }

        $qry = "SELECT p.*, c.nama AS nama_pelanggan, jj.jenis AS jenis_jasa
                FROM pesanan p
                JOIN jns_jasa as jj ON p.jns_jasa = jj.kode
                JOIN customer as c ON p.kode_customer = c.kode "
            . $where . $qrt . $qryp . $qrys . " ORDER BY " . $order;
        // echo $qry;
        $query = $this->db->query($qry);
        $result = $query->result_array();
        $data['result'] = $result;
        $data['title'] = 'Laporan Rekapulasi';

        $this->load->view('admin/rekap_rpt', $data);
    }

    function ubahPassword()
    {
        $cekSession = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        if ($cekSession == '') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger py-2" role="alert">Anda belum auth_user.</div>');
            redirect('auth_user');
        }
        $data['dataAdm'] = $cekSession;
        $data['title'] = 'Ubah Password';
        $data['active'] = 'Password';

        $this->global['page_title'] = 'Pesanan - Admin Laundry';
        $this->loadViewsAdmin('admin/ubahPassword', $this->global, $data, NULL, TRUE);
    }
}
