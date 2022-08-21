<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class DriverPage extends BaseController
{

    public function pesanan()
    {
        $cekSession = $this->db->get_where('driver', ['email' => $this->session->userdata('email')])->row_array();
        if ($cekSession == '') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger py-2" role="alert">Anda belum auth_user.</div>');
            redirect('auth_user');
        }
        $kodeMe = $cekSession['kode'];
        $data['pesanan'] = $this->Pesanan_model->getPesananD($kodeMe);
        $data['dataAdm'] = $cekSession;
        $data['title'] = 'Pesanan';
        $data['active'] = 'Pesanan';

        $this->global['page_title'] = 'Pesanan - Driver Laundry';
        $this->loadViewsD('driver/pesanan', $this->global, $data, NULL, TRUE);
    }

    function getPesanInfo()
    {
        $kode = $this->input->post('kode');
        $data['getPesanInfo'] = $this->Pesanan_model->getPesananInfo($kode);
        echo json_encode(array('success' => 'berhasil', 'data' => $data));
    }

    function accBooking()
    {
        $kode = $this->input->post('kode');
        $UpdateFlag = "UPDATE pesanan SET `status` = 'D' WHERE kode = '" . $kode . "' ";
        $update = $this->db->query($UpdateFlag);
        echo json_encode(array('success' => 'berhasil'));
    }
    function antarPsn()
    {
        $kode = $this->input->post('kode');
        $UpdateFlag = "UPDATE pesanan SET `status` = 'S' WHERE kode = '" . $kode . "' ";
        $update = $this->db->query($UpdateFlag);
        echo json_encode(array('success' => 'berhasil'));
    }

    function cariNamabrg()
    {
        $barang = $this->input->post('barang');
        $qry = "SELECT * FROM data_barang WHERE nama = '" . $barang . "' ";
        $data = $this->db->query($qry)->row_array();
        // print_r();
        echo json_encode($data['harga']);
    }

    function Updatebooking()
    {
        $kode = $this->input->post('kode');
        $qty = $this->input->post('qty');
        $harga = $this->input->post('harga');
        $diskon = $this->input->post('diskon');
        $netto = $this->input->post('netto');
        $jns_brg = $this->input->post('jns_brg');
        $UpdateFlag = "UPDATE pesanan SET `qty` = " . $qty . ", `jenis_barang` = '" . $jns_brg . "', `harga` = " . $harga . ", `diskon` = " . $diskon . ", `netto` = " . $netto . " 
                        WHERE kode = '" . $kode . "' ";
        $update = $this->db->query($UpdateFlag);
        echo json_encode(array('success' => 'berhasil'));
    }

    public function upPesanan()
    {
        $cekSession = $this->db->get_where('driver', ['email' => $this->session->userdata('email')])->row_array();
        if ($cekSession == '') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger py-2" role="alert">Anda belum auth_user.</div>');
            redirect('auth_user');
        }
        $kodeMe = $cekSession['kode'];
        $data['pesanan'] = $this->Pesanan_model->getPesananDt($kodeMe);
        $data['dataAdm'] = $cekSession;
        $data['title'] = 'Update Pesanan';
        $data['active'] = 'upPesanan';

        $this->global['page_title'] = 'Update Pesanan - Driver Laundry';
        $this->loadViewsD('driver/upPesanan', $this->global, $data, NULL, TRUE);
    }
    function ubahPassword()
    {
        $cekSession = $this->db->get_where('driver', ['email' => $this->session->userdata('email')])->row_array();
        if ($cekSession == '') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger py-2" role="alert">Anda belum auth_user.</div>');
            redirect('auth_user');
        }
        $data['dataAdm'] = $cekSession;
        $data['title'] = 'Ubah Password';
        $data['active'] = 'Password';

        $this->global['page_title'] = 'Pesanan - Driver Laundry';
        $this->loadViewsD('driver/ubahPassword', $this->global, $data, NULL, TRUE);
    }
}
