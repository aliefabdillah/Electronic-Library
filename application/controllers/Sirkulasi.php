<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sirkulasi extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		
		if($this->session->userdata('login') != TRUE){
			$this->session->set_flashdata('error_message', 'Anda Harus Login Terlebih Dahulu!');
            redirect(base_url().'login/showSignIn');
        }
    }

	public function displayData()
	{
		//mengatur akses agar hanya admin yang bisa masuk ke laman sirkulasi
		if ($_SESSION['akses'] != 'admin') {
			$this->session->set_flashdata('error_message', 'Akses Ditolak! Login Sebagai Admin Untuk Mengakses Laman');
            redirect(base_url().'login/showSignIn');
		}
		$data['data_sirkulasi'] = $this->m_sirkulasi->get_sirkulasi();
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
		$this->load->view('sirkulasi', $data);
		$this->load->view('templates/footer');
	}

	public function displayRequest($id=null)
	{
		//menampilkan request peminjaman
		$data['data_request'] = $this->m_sirkulasi->get_request($id);
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
		$this->load->view('request', $data);
		$this->load->view('templates/footer');
	}

	public function searchData()
	{
		//fitur search
        $keyword = $this->input->get('search');
        
		if ($_SESSION['akses'] = 'admin') {
			$data['data_sirkulasi'] = $this->m_sirkulasi->search($keyword);
			$this->load->view('templates/navbar');
			$this->load->view('templates/sidebar');
			$this->load->view('sirkulasi', $data);
			$this->load->view('templates/footer');
		}else {
			$data['data_request'] = $this->m_sirkulasi->search($keyword);
			$this->load->view('templates/navbar');
			$this->load->view('templates/sidebar');
			$this->load->view('request', $data);
			$this->load->view('templates/footer');
		}
    }

	public function makeRequest(){
		//method membuat request peminjaman
		$data['kode_transaksi'] = $this->m_sirkulasi->createKodeTransaksi();
		$data['judul'] = $this->input->post('judul');
		$data['tgl_pinjam'] = $this->input->post('tgl_pinjam');
		$data['tgl_kembali'] = $this->input->post('tgl_kembali');
		$data['kode_anggota'] = $this->input->post('kode_anggota');
		$data['kode_koleksi'] = $this->input->post('kode_koleksi');

		if ($_SESSION['akses'] == 'member') {
			//jika user adalah member, maka status peminjaman adalah request terlebih dahulu
			$data['status'] = 'Request';
			$this->m_sirkulasi->add($data);
			redirect(base_url().'sirkulasi/displayRequest/'.$_SESSION['kode'].'');
		}else {
			//jika user adalah admin, maka status peminjaman adalah dipinjam
			$data['kode_transaksi'] = $this->m_sirkulasi->createKodeTransaksi();
			$data['status'] = 'Dipinjam';
			$this->m_sirkulasi->add($data);
			$this->m_koleksi->updateStatus('Dipinjam', $data['kode_koleksi']);
			redirect(base_url().'sirkulasi/displayData');
		}
	}

	public function addData()
	{
		//tambah data sirkulasi
		$data['kode_transaksi'] = $this->m_sirkulasi->createKodeTransaksi();
		$data['judul'] = $this->input->post('judul');
		$data['tgl_pinjam'] = $this->input->post('tgl_pinjam');
		$data['tgl_kembali'] = $this->input->post('tgl_kembali');
		$data['status'] = 'Dipinjam';
		$data['kode_anggota'] = $this->input->post('kode_anggota');
		$data['kode_koleksi'] = $this->input->post('kode_koleksi');

		$this->m_sirkulasi->add($data);
		$this->m_koleksi->updateStatus('Dipinjam', $data['kode_koleksi']);
		redirect(base_url().'sirkulasi/displayData');
	}

	public function deleteData(){
		//hapus data peminjaman
		$id_peminjaman = $this->input->post('id_peminjaman');
		
        $this->m_sirkulasi->delete($id_peminjaman);
		
		if ($_SESSION['akses'] == 'admin') {
			//jika hak akses admin
			$kode_koleksi = $this->input->post('kode_koleksi');
			$this->m_koleksi->updateStatus('Tersedia', $kode_koleksi);
			redirect(base_url().'sirkulasi/displayData');
		}else {
			redirect(base_url().'sirkulasi/displayRequest/'.$_SESSION['kode'].'');
		}
    }

	public function updateStatusPinjam($id_peminjaman, $kode_koleksi)
	{
		//update status peminjaman
		$this->m_sirkulasi->updateStatus('Dikembalikan', $id_peminjaman);
		$this->m_koleksi->updateStatus('Tersedia', $kode_koleksi);
		redirect(base_url().'sirkulasi/displayData');
	}

	public function validationRequest($id_peminjaman, $kode_koleksi, $status)
	{
		if ($status == 1) {
			// jika peminjaman disetujui
			// $data['kode_transaksi'] = $this->m_sirkulasi->createKodeTransaksi();
			$data['status'] = 'Dipinjam';
			$this->m_sirkulasi->updateStatus($data, $id_peminjaman);
			$this->m_koleksi->updateStatus('Dipinjam', $kode_koleksi);
			redirect(base_url().'sirkulasi/displayData');
		}else {
			$data['status'] = 'Not Accepted';
			$this->m_sirkulasi->updateStatus($data, $id_peminjaman);
			redirect(base_url().'sirkulasi/displayRequest');
		}
	}
}
