<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Driver extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $cekSession = $this->db->get_where('driver', ['email' => $this->session->userdata('email')])->row_array();
        if ($cekSession != '') {
            redirect('dashboard/home');
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
            $this->load->view('driver/login');
        }
    }

    private function _login() {

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $driver = $this->db->get_where('driver', ['email' => $email])->row_array(); 
        // print_r(password_verify($password, $driver['password'])); die();
        if ($driver) {
            if ($driver['status'] > 0) {
                if (password_verify($password, $driver['password'])) {
                    $data = [
                        'email' => $driver['email']
                    ];
                    $this->session->set_userdata($data);
                    redirect('dashboard/home');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger py-1" role="alert">Email atau password salah.</div>');
                    redirect('driver');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger py-1" role="alert">Maaf, akun anda tidak aktif!</div>');
                redirect('driver');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger py-1" role="alert">Maaf, email anda belum terdaftar!</div>');
            redirect('driver');
        }
    }

    public function register()
    {
        
        $this->form_validation->set_rules('nama', 'Nama lengkap', 'trim|required',[
            'required' => 'Nama harus diisi!'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[driver.email]', [
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
            $this->load->view('driver/register');
        } else {
            $cekkode = $this->db->query('SELECT kode FROM driver ORDER BY KODE DESC LIMIT 1')->result_array();
            $kode = $cekkode[0]['kode'];
            if ($kode != '') {
                $kode = sprintf("%05d", $kode+1);
            } else {
                $kode = '00001';
            }
            $email = $this->input->post('email', true);
            
            $new_date = date('Y-m-d');

            $data = [
                'kode'      => $kode,
                'nama'      => $this->input->post('nama'),
                'alamat'    => $this->input->post('alamat'),
                'no_telp'   => $this->input->post('no_telp'),
                'email'     => $email,
                'password'  => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'status'    => 1
            ];

            $this->db->insert('driver', $data); 
            $this->session->set_flashdata('message', '<div class="alert alert-success py-2" role="alert">Selamat! akun kamu berhasil dibuat.</div>');
            redirect('driver');
        }
    }
    public function logout()
    { 
        $this->session->unset_userdata('email'); 
        $this->session->set_flashdata('message', '<div class="alert alert-success py-1" role="alert">Anda telah logout.</div>');
        redirect('driver');
    } 

    function cekUbahPassword()
    {
        $data['driver'] = $this->db->get_where('driver', ['email' => $this->session->userdata('email')])->row_array();
        $currPass = $data['driver']['password'];
        $current_password = $this->input->post('current_password');
        $new_password = $this->input->post('new_password1');

        // cek password user yg telah ada di database
        if (!password_verify($current_password, $currPass)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Isi Password saat ini dengan benar!</div>');
            
        } else { // Jika password benar kemudian
            // cek Password baru , tidak boleh sama dengan Password lama
            if ($current_password == $new_password) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Password saat ini salah!</div>');
                
            } else {
                // Password sudah OK nih
                $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                $this->db->set('password', $password_hash);
                $this->db->where('email', $this->session->userdata('email'));
                $this->db->update('driver');

                $success = $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Password anda berhasil diubah.</div>');
                if ($success != '') {
                    $data = array('status' => 'success', 'data' => $success);
                } else {
                    $data = array('status' => 'failed');
                }
                
                echo json_encode(array('status' => 'success', 'data' => $success)); 
            }
        }
    }
}
