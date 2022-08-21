<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Home extends BaseController
{
    public function index()
    {
        // $cekSession = $this->db->get_where('customer', ['email' => $this->session->userdata('email')])->row_array();
        // if ($cekSession == '') {
        //     $this->session->set_flashdata('message', '<div class="alert alert-danger py-2" role="alert">Anda belum login.</div>');
        //     redirect('login');
        // }
        $data['title'] = 'Home';
        $data['active'] = 'HOME';
        $data['now'] = $this->hari_ini();
        $this->global['page_title'] = 'Selamat datang | Laundry';
        $this->loadViews('home', $this->global, $data, NULL, TRUE);
    }
    function pesanan()
    {
        $cekSession = $this->db->get_where('customer', ['email' => $this->session->userdata('email')])->row_array();
        if ($cekSession == '') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger py-2" role="alert">Login terlebih dahulu untuk melihat pesanan.</div>');
            redirect('login');
        }
        $data['title'] = 'Pesanan';
        $data['active'] = 'PESANAN';
        $data['now'] = $this->hari_ini();
        $kodeme = $cekSession['kode'];
        $data['pesananSaya'] = $this->Pesanan_model->pesananSaya($kodeme);
        $this->global['page_title'] = 'Pesanan | Laundry';
        $this->loadViews('pesanan', $this->global, $data, NULL, TRUE);
    }
    function riwayatPesanan()
    {
        $cekSession = $this->db->get_where('customer', ['email' => $this->session->userdata('email')])->row_array();
        if ($cekSession == '') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger py-2" role="alert">Anda belum login.</div>');
            redirect('login');
        }
        $kodeme = $cekSession['kode'];
        $data['Me'] = $cekSession;
        $data['pesananSaya'] = $this->Pesanan_model->rPesananSaya($kodeme);
        $data['title'] = 'Riwayat Pesanan';
        $data['active'] = 'RPESANAN';
        $data['now'] = $this->hari_ini();
        $this->global['page_title'] = 'Riwayat Pesanan | Laundry';
        $this->loadViews('r_pesanan', $this->global, $data, NULL, TRUE);
    }

    function hari_ini()
    {
        date_default_timezone_set('Asia/Jakarta');
        $hari = date("D");

        switch ($hari) {
            case 'Sun':
                $hari_ini = "Minggu";
                break;

            case 'Mon':
                $hari_ini = "Senin";
                break;

            case 'Tue':
                $hari_ini = "Selasa";
                break;

            case 'Wed':
                $hari_ini = "Rabu";
                break;

            case 'Thu':
                $hari_ini = "Kamis";
                break;

            case 'Fri':
                $hari_ini = "Jumat";
                break;

            case 'Sat':
                $hari_ini = "Sabtu";
                break;

            default:
                $hari_ini = "Tidak di ketahui";
                break;
        }
        return $hari_ini;

        // return "<b>" . $hari_ini . "</b>";

    }
}
