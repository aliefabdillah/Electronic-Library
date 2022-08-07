<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
    }

	public function showSignIn(){
        $this->load->view('signIn');
    }

    public function signInAuth()
    {
        //ambil input form
        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));

        //cek apakah email dan password sesuai
        $cek_login = $this->m_login->cek_login($email, $password);
        if ($cek_login->num_rows() > 0) {
            //mengambil data login
            $data = $cek_login->row_array();
            $this->session->set_userdata('login', TRUE);                        //set session login menjadi true
            if ($data['level'] == 1) {
                //jika user yang login adalah admin
                $this->session->set_userdata('akses', 'admin');
                $this->session->set_userdata('nama', $data['nama']);
                $this->session->set_userdata('email', $data['email']);
            }else {
                //jika user yang login adalah anggota
                $dataAnggota = $this->m_login->getKodeAnggota($email);
                $data_anggota = $dataAnggota->row_array();
                $this->session->set_userdata('akses', 'member');
                $this->session->set_userdata('nama', $data['nama']);
                $this->session->set_userdata('email', $data['email']);
                $this->session->set_userdata('kode', $data_anggota['kode_anggota']);
            }
            redirect(base_url());
        }else {
            $this->session->set_flashdata('error_message', 'Email atau Password Salah!');
            redirect(base_url().'login/showSignIn');
        }
    }

    function signOut(){
        //jika user adalah member
        if ($_SESSION['akses'] == 'member') {
            $this->session->unset_userdata('kode', '');
        }
        
        $this->session->unset_userdata('akses', '');
        $this->session->unset_userdata('email', '');
        $this->session->unset_userdata('nama', '');
        $this->session->unset_userdata('login', '');
        $this->session->set_flashdata('error_message', 'Anda Telah Logout!');
        redirect(base_url().'login/showSignIn');
    }
}
