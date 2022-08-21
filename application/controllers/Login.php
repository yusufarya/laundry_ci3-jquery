<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $cekSession = $this->db->get_where('customer', ['email' => $this->session->userdata('email')])->row_array();
        if ($cekSession != '') {
            redirect('home');
        }
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email',[
            'required'=> 'Email harus diisi.'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required',[
            'required'=> 'Password harus diisi!'
        ]);
        if ($this->form_validation->run() != false) {
            $this->_login();
        } else {
            $this->load->view('auth/login');
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $customer = $this->db->get_where('customer', ['email' => $email])->row_array();
        // print_r(password_verify($password, $customer['password'])); die();
        if ($customer) {
            if ($customer['status'] > 0) {
                if (password_verify($password, $customer['password'])) {
                    $data = [
                        'email' => $customer['email'],
                        'role' => $customer['role_id']
                    ];
                    $this->session->set_userdata($data);
                    redirect('home');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger py-1" role="alert">Email atau password salah.</div>');
                    redirect('login');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger py-1" role="alert">Maaf, akun anda tidak aktif!</div>');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger py-1" role="alert">Maaf, email anda belum terdaftar!</div>');
            redirect('login');
        }
    }

    public function register()
    {
        
        $this->form_validation->set_rules('nama', 'Nama lengkap', 'trim|required',[
            'required' => 'Nama harus diisi!'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[customer.email]', [
            'required' => 'Email harus diisi!',
            'is_unique' => 'Maaf, email sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[6]|matches[password2]', [
            'required' => 'password harus diisi!',
            'min_legth' => 'Password must be longer than 6 characters',
            'matches'   => 'Password dont match!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'trim|matches[password2]');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/register');
        } else {
            // echo "oke"; die();
            $cekkode = $this->db->query('SELECT kode FROM customer ORDER BY KODE DESC LIMIT 1')->result_array();
            $kode = $cekkode[0]['kode'];
            if ($kode != '') {
                $kode = sprintf("%05d", $kode+1);
            } else {
                $kode = '00001';
            }
            $email = $this->input->post('email', true);
            $tgl_lahir = $this->input->post('tgl_lahir', true);
            // $tgllahir = date($tgl_lahir, 'Y-m-d');
            // print_r($tgl_lahir); die();
            $new_date = date('Y-m-d');

            $data = [
                'kode'      => $kode,
                'nama'      => $this->input->post('nama'),
                'jenis_kel' => $this->input->post('jenis_kel'),
                'alamat'    => $this->input->post('alamat'),
                // 'no_telp'   => $this->input->post('no_telp'),
                'tgl_lahir' => $tgl_lahir,
                'email'     => $email,
                'password'   => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'status'     => 1,
                'role_id'     => 3,
                'gambar'     => 'default.jpg',
                'tgl_dibuat' => $new_date
            ];

            $this->db->insert('customer', $data);
            
            $this->session->set_flashdata('message', '<div class="alert alert-success py-2" role="alert">Selamat! akun kamu berhasil dibuat.</div>');
            redirect('login');
        }
    }
    public function logout()
    {
        // $this->session->sess_destroy();
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success py-1" role="alert">Anda telah logout.</div>');
        redirect('login');
    }
}
