<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Customer extends BaseController
{

    public function index()
    {
        $cekSession = $this->db->get_where('customer', ['email' => $this->session->userdata('email')])->row_array();
        if ($cekSession == '') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger py-2" role="alert">Anda belum login.</div>');
            redirect('login');
        }

        $data['me'] = $cekSession;
        $data['title'] = 'Profile';
        $data['active'] = 'Profile';

        $this->global['page_title'] = 'Laundry | Profile';
        $this->loadViews('cust/profile', $this->global, $data, NULL, TRUE);
    }

    function updateProfile () {

        $kode = $this->input->post('kode');
        $nama = $this->input->post('nama');
        $jnskel = $this->input->post('jnskel');
        $tgl_lahir = $this->input->post('tgl_lahir');
        $no_telp = $this->input->post('no_telp');
        $alamat = $this->input->post('alamat');
        $status = $this->input->post('status');

        $this->db->set('nama', $nama);
        $this->db->set('jenis_kel', $jnskel);
        $this->db->set('tgl_lahir', $tgl_lahir);
        $this->db->set('no_telp', $no_telp);
        $this->db->set('alamat', $alamat);
        $this->db->set('status', $status);

        $this->db->where('kode', $kode); // WHERE KODE

        $result = $this->db->update('customer'); // UPDATE KE TB customer
        if ($result == 1) {
            echo json_encode('success');
        } else {
            echo json_encode('error');
        }
    }

}
