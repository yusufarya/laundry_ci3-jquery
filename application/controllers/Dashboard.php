<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Dashboard extends BaseController
{

    public function index()
    {
        $cekSession = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        if ($cekSession == '') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger py-2" role="alert">Anda belum login.</div>');
            redirect('auth_user');
        }

        $data['dataAdm'] = $cekSession;
        $data['title'] = 'Dashboard Admin';
        $data['active'] = 'Dashboard';

        $this->global['page_title'] = 'Dashboard | Admin Laundry';
        $this->loadViewsAdmin('admin/dashboard', $this->global, $data, NULL, TRUE);
    }

    public function home()
    {
        $cekSession = $this->db->get_where('driver', ['email' => $this->session->userdata('email')])->row_array();
        if ($cekSession == '') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger py-2" role="alert">Anda belum login.</div>');
            redirect('auth_user');
        }

        $data['dataAdm'] = $cekSession;
        $data['title'] = 'Dashboard Driver';
        $data['active'] = 'Dashboard';

        $this->global['page_title'] = 'Home | Driver Laundry';
        $this->loadViewsD('driver/dashboard', $this->global, $data, NULL, TRUE);
    }
}
