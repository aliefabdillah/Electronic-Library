<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        // $this->load->helper(array('form', 'url'));
        // $this->load->model("m_register");
        // $this->load->model("m_anggota");
        // $this->load->library('session');
        // $this->load->library('form_validation');
    }

    public function showRegister(){
        $this->load->view('register');
    }

    // menambahkan data dari form register ke tabel login dan anggota
    public function submitRegister()
    {
        $this->form_validation->set_rules('nama','Nama','required|min_length[5]|max_length[255]');
		$this->form_validation->set_rules('telepon','Telepon','required');
		$this->form_validation->set_rules('email','Email','required|min_length[5]|max_length[100]|is_unique[tbl_login.email]');
		$this->form_validation->set_rules('password','Password','required|min_length[8]|max_length[20]');

        if ($this->form_validation->run() == true) {
            // array untuk dimasukan ke dalam tabel anggota
            $data_anggota['kode_anggota'] = $this->m_anggota->createKodeAnggota();
            $data_anggota['nama'] = $this->input->post('nama');
            $data_anggota['no_telepon'] = $this->input->post('telepon');
            $data_anggota['email'] = $this->input->post('email');
            $data_anggota['tgl_aktif'] = date('Y-m-d');
            
            // array untuk dimasukan ke dalam tabel login
            $data_login['nama'] = $this->input->post('nama');
            $data_login['email'] = $this->input->post('email');
            $data_login['password'] = md5($this->input->post('password'));
            $data_login['level'] = 2;
    
            // tambah data
            $res1 = $this->m_register->add($data_login);
            $res2 = $this->m_anggota->add($data_anggota);
    
            if ($res1 && $res2) {
                $this->session->set_flashdata('message', 'Register Berhasil!');
                redirect(base_url().'login/showSignIn');
            }
            else {
                $this->session->set_flashdata('message', 'Register Gagal!');
                redirect(base_url().'register/showRegister');
            }
        }else {
            return $this->load->view('register');
        }
    }
}
