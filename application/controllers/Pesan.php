<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Pesan extends BaseController
{

    function index()
    {
        $cekSession = $this->db->get_where('customer', ['email' => $this->session->userdata('email')])->row_array();
        if ($cekSession == '') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger py-2" role="alert">Anda belum login.</div>');
            redirect('login');
        }
        $data['title'] = 'Form Pesan';
        $data['active'] = 'PESAN';
        $data['Me'] = $cekSession;
        $this->global['page_title'] = 'Form Pesanan | Laundry';
        $this->loadViews('formPesan', $this->global, $data, NULL, TRUE);
    }

    function getAlamat()
    {
        $kode = $this->input->post('kodecust');
        $data = $this->User_model->getCurrLoc($kode);
        echo json_encode(array('success' => $data));
    }

    function getJns_pengiriman()
    {

        $kode = $this->input->post('kode');
        $data = $this->Pesanan_model->getKdPengiriman($kode);
        $status = '';
        if ($data != '') {
            $status = array('status' => 'success');
        } else {
            $status = array('status' => 'failed');
        }
        echo json_encode(array('data' => $data));
    }

    function getHrgsat()
    {
        $data = $this->Pesanan_model->getHrgSat();
        echo json_encode(array('success' => $data));
    }

    function addPesanan()
    {
        $kode = $this->input->post('kode');
        $kodecust = $this->input->post('kodecust');
        $no_telp = $this->input->post('notelp');
        $alamat = $this->input->post('alamat');
        $jns_jasa = $this->input->post('jns_jasa');
        $jam = $this->input->post('jam');
        $ket = $this->input->post('ket');
        $tgl = $this->input->post('tgl');
        $jns_brg = $this->input->post('jns_brg');
        $barang = $this->input->post('barang');

        $pesanDetail = array('kode' => $kode, 'kode_customer' => $kodecust, 'no_telp' => $no_telp, 'alamat' => $alamat, 'keterangan' => $ket, 'jns_jasa' => $jns_jasa, 'jam' => $jam, 'tanggal' => $tgl, 'jenis_barang' => $jns_brg, 'status' => ' ', 'barang' => $barang);
        $this->Pesanan_model->insertPesanan($pesanDetail);
        echo json_encode(array('success' => 'berhasil'));
    }

    function getPesankode()
    {
        $kode = $this->input->post('kode');
        $qry = "SELECT p.*, jj.jenis AS jjasa, jj.harga AS ongkos, d.nama AS ndriver
                FROM pesanan p
                JOIN driver AS d ON d.kode = p.driver
                JOIN jns_jasa AS jj ON jj.kode = p.jns_jasa
                WHERE p.kode = '" . $kode . "' ";
        $data = $this->db->query($qry)->row_array();
        echo json_encode($data);
    }

    function getNorek()
    {
        $kode = $this->input->post('kode');
        $qry = "SELECT * FROM `tb_bayar` WHERE pesanan = '" . $kode . "' ";
        $data = $this->db->query($qry)->row_array();
        echo json_encode($data);
    }

    function insertBayar()
    {
        $kodeP = $this->input->post('kode');
        $bank = $this->input->post('bank');
        $waktu = date('ymd');
        $qry = "SELECT * FROM `tb_bayar` ORDER BY kode DESC LIMIT 1";
        $getKodetr = $this->db->query($qry)->row_array();

        $kodetr = '';
        $urut = 000;

        $cekkode = count($getKodetr);
        if ($cekkode <= 0) {
            $kodes = 'TRN' . $waktu;
            $kode = sprintf('%03d', $urut + 1);
            $kodetr = $kodes . $kode;
        } else {
            $kod = $getKodetr['kode'];
            $kodes = substr($kod, 0, 9);
            $urut = substr($kod, 9, 11);
            $kode = sprintf('%03d', $urut + 1);
            $kodetr = $kodes . $kode;
        }

        $data = [
            'kode'      => $kodetr,
            'pesanan'   => $kodeP,
            'bank'      => $bank,
            'tanggal'   => date('Y-m-d')
        ];
        $inTF = $this->db->insert('tb_bayar', $data);

        if ($inTF > 0) {
            $UpBayar = "UPDATE pesanan SET bayar = 'Y' WHERE kode = '" . $kodeP . "' ";
            $update = $this->db->query($UpBayar);
            $status = array('status' => 'success');
        } else {
            $status = array('status' => 'failed');
        }
        echo json_encode($status);
    }

    function cekBayar() {
        $kode = $this->input->post('kode');

        $qry = "SELECT * FROM `pesanan` WHERE kode = '".$kode."' ";
        $res = $this->db->query($qry)->result();

        echo json_encode($res);
    }

    function noRek()
    {
        $bank = $this->input->post('bank');

        $qry = "SELECT * FROM `bank` WHERE nama = '" . $bank . "' ";
        $data = $this->db->query($qry)->row_array();
        echo json_encode($data);
    }

    function kodeRek()
    {
        $kodeP = $this->input->post('kodeP');

        $qry = "SELECT * FROM `tb_bayar` WHERE pesanan = '" . $kodeP . "' ";
        $data = $this->db->query($qry)->row_array();
        echo json_encode($data);
    }

    function kirimBuktiBayar()
    {
        $kodetr = $this->input->post('kd_byr');

        $upload_image = $_FILES['img']['name'];
        if ($upload_image != '') {
            $config['allowed_types']    = 'gif|jpg|jpeg|png';
            $config['max_size']            = '1024';
            $config['upload_path']         = './assets/img/pembayaran/';
            if (!is_dir('./assets/img/pembayaran/')) {
                mkdir('./assets/img/pembayaran', 0777, TRUE);
            }
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('img')) {

                $new_image = $this->upload->data('file_name');
                $this->db->set('gambar', $new_image);
                $this->db->where('pesanan', $kodetr);
                $this->db->update('tb_bayar');
                $this->session->set_flashdata('message', '<div class="alert alert-success py-1 UploadOk" role="alert">Berhasil.✔️ Bukti pembayaran berhasil dikirim.</div>');
                $kdPByr = $this->db->query("SELECT pesanan FROM tb_bayar WHERE pesanan = '" . $kodetr . "'")->row_array();
                $kdpesan = $kdPByr['pesanan'];
                $this->db->set('bayar', 'YY');
                $this->db->where('kode', $kdpesan);
                $this->db->update('pesanan');
                redirect('home/pesanan');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger py-1 errUpload" role="alert">' . $this->upload->display_errors() . '</div>');
                redirect('home/pesanan');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger py-1 errUpload" role="alert">Proses gagal. ❌ tidak ada file yg dipilih.</div>');
            redirect('home/pesanan');
        }
    }

    function penilaian()
    {
        $kode = $this->input->post('kode');
        $nama = $this->input->post('nama');
        $nilai = $this->input->post('rate');
        $komen = $this->input->post('komentar');

        $dataIn = [
            'kode_pesan' => $kode,
            'nama' => $nama,
            'nilai' => $nilai,
            'komentar' => $komen,
            'waktu'        => date('Y-m-d')
        ];
        $hasil = $this->db->insert('komentar', $dataIn);

        if ($hasil == 1) {
            $updateP = "UPDATE pesanan SET penilaian = 'Y' WHERE kode = '" . $kode . "'  ";
            $this->db->query($updateP);
            echo json_encode('success');
        } else {
            echo json_encode('error');
        }
    }

    function getNilai()
    {
        $kode = $this->input->post('kode');
        $get = "SELECT * FROM `komentar` WHERE kode_pesan = '" . $kode . "' ";
        $resN = $this->db->query($get)->row_array();
        echo json_encode($resN);
    }
}
