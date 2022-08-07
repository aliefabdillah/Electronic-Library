<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Koleksi extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
    }
    
	public function displayKoleksi($id)
	{
		$data['data_biblio'] = $this->m_koleksi->get_foto_judul($id);
		$data['data_koleksi'] = $this->m_koleksi->get_koleksi($id); 
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
		$this->load->view('koleksi', $data);
		$this->load->view('templates/footer');
	}

	public function displayFormEdit($id_koleksi)
	{
		$data['data_koleksi'] = $this->m_koleksi->get_koleksiById($id_koleksi);
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
		$this->load->view('form/formEditKoleksi', $data);
		$this->load->view('templates/footer');
	}

	public function submitAdd()
	{
		//validasi tambah koleksi
		$this->form_validation->set_rules('posisi_rak','Posisi Rak','required|is_unique[tbl_koleksi.posisi_rak]');
		$this->form_validation->set_rules('kondisi','Kondisi','required');
		
		$data_koleksi['id_biblio'] = $this->input->post('id_biblio');

		if ($this->input->post('kode_koleksi') != "") {
			$data_koleksi['kode_koleksi'] = $this->input->post('kode_koleksi');
		}else {
			//jika null maka auto generate kode koleksi
			$data_koleksi['kode_koleksi'] = $this->m_koleksi->createKodeKoleksi();
		}

		if ($this->form_validation->run() == true) 
		{
			//check validasi input
			$data_koleksi['posisi_rak'] = $this->input->post('posisi_rak');
			$data_koleksi['kondisi'] = $this->input->post('kondisi');
			
			if ($data_koleksi['kode_koleksi'] == '#REF') {
				//jika koleksi adalah referensi
				$data_koleksi['status'] = 'Tidak Dapat Dipinjam';
			}
			else {
				$data_koleksi['status'] = 'Tersedia';
			}

			$res = $this->m_koleksi->add($data_koleksi);
			if ($res) {
				$this->session->set_flashdata('message', 'Tambah Data Berhasil!');
				redirect(base_url().'koleksi/displayKoleksi/'.$data_koleksi['id_biblio'].'');
			}
			else {
				$this->session->set_flashdata('error_message', 'Tambah Data Gagal!');
				redirect(base_url().'koleksi/displayKoleksi/'.$data_koleksi['id_biblio'].'');
			}
		}else {
			$this->session->set_flashdata('error_message', 'Posisi Rak Telah Diisi!');
			redirect(base_url().'koleksi/displayKoleksi/'.$data_koleksi['id_biblio'].'');
		}
	}

	public function submitEdit()
	{
			
		// menyimpan data dari form ke dalam array
		$id_koleksi = $this->input->post('id_koleksi');
		$id_biblio = $this->input->post('id_biblio');

		// check apakah ada perubahan pada input form kode koleksi
		$cekInput = $this->m_koleksi->cekField('kode_koleksi', $this->input->post('kode_koleksi'), $id_koleksi);
		if ($cekInput == false) {
			//jika input nomor registrasi bukan ref
			if ($this->input->post('kode_koleksi') != '#REF' && $this->input->post('kode_koleksi') == ""){
				$data_koleksi['kode_koleksi'] = $this->m_koleksi->createKodeKoleksi();
				// cek apakah no reg baru duplikat atau tidak
				// $this->form_validation->set_rules('kode_koleksi','Koleksi','required');
				// if ($this->form_validation->run() == true) {
				// 	$data_koleksi['kode_koleksi'] = $this->input->post('kode_koleksi');
				// }
				// else {
				// 	$this->session->set_flashdata('error_message', validation_errors());
				// 	redirect(base_url().'koleksi/displayFormEdit/'.$id_koleksi.'');
				// }
			}
			else {
				$data_koleksi['kode_koleksi'] = $this->input->post('kode_koleksi');
			}
		}

		// check apakah ada perubahan pada form posisi rak
		$cekInput = $this->m_koleksi->cekField('posisi_rak', $this->input->post('posisi_rak'), $id_koleksi);
		if ($cekInput == false) {
			$this->form_validation->set_rules('posisi_rak','Posisi Rak','required|is_unique[tbl_koleksi.posisi_rak]');
			if ($this->form_validation->run() == true) {
				$data_koleksi['posisi_rak'] = $this->input->post('posisi_rak');
			}
			else {
				$this->session->set_flashdata('error_message', validation_errors());
				redirect(base_url().'koleksi/displayFormEdit/'.$id_koleksi.'');
			}
		}

		// input data status koleksi
		if ($this->input->post('kode_koleksi') == '#REF') {
			$data_koleksi['status'] = 'Tidak Dapat Dipinjam';
		}else {
			$data_koleksi['status'] = 'Tersedia';
		}

		//input data kondisi
		$data_koleksi['kondisi'] = $this->input->post('kondisi');		

		
		$res = $this->m_koleksi->update($data_koleksi, $id_koleksi);
		if ($res) {
			$this->session->set_flashdata('message', 'Update Data Berhasil!');
			redirect(base_url().'koleksi/displayKoleksi/'.$id_biblio.'');
		}
		else {
			$this->session->set_flashdata('error_message', 'Update Data Gagal!');
			redirect(base_url().'koleksi/displayKoleksi/'.$id_biblio.'');
		}
	}

	public function submitDelete()
	{
		// menyimpan data dari form ke dalam array
		$id_delete = $this->input->post('id_koleksi');
		$id_biblio = $this->input->post('id_biblio');

		$res = $this->m_koleksi->delete($id_delete);
		if ($res) {
			$this->session->set_flashdata('message', 'Hapus Data Berhasil!');
			redirect(base_url().'koleksi/displayKoleksi/'.$id_biblio.'');
		}
		else {
			$this->session->set_flashdata('error_message', 'Hapus Data Gagal!');
			redirect(base_url().'koleksi/displayKoleksi/'.$id_biblio.'');
		}
	}

	public function updateStatusKoleksi($kode_koleksi){
		//update status koleksi menjadi tersedia
		$this->m_koleksi->updateStatus('Tersedia', $kode_koleksi);
		redirect(base_url().'sirkulasi/displayData');
	}
}
