<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        // $this->load->model("m_login");
        // $this->load->model("m_anggota");
        // $this->load->model("m_sirkulasi");
        // $this->load->library('form_validation');
		
		// Kondisi ketika masuk ke halaman anggota harus melakukan login terlebih dahulu
		if($this->session->userdata('login') != TRUE){
			$this->session->set_flashdata('error_message', 'Anda Harus Login Terlebih Dahulu!');
            redirect(base_url().'login/showSignIn');
        }
    }

	public function displayAnggota()
	{
		//menampilkan data anggota
		if ($_SESSION['akses'] == 'admin') {
			$data['data_anggota'] = $this->m_anggota->get_anggota();
			$this->load->view('templates/navbar');
			$this->load->view('templates/sidebar');
			$this->load->view('anggota', $data);
			$this->load->view('templates/footer');
		}
		else {
			$this->session->set_flashdata('error_message', 'Anda Harus Login Terlebih Dahulu!');
            redirect(base_url().'login/showSignIn');
		}
	}
	
	public function displayAnggotaDetail($kode_anggota)
	{
		//method cek apakah data anggota ada yang masih kosong
		$cekNull = $this->m_anggota->cekFieldisNull($kode_anggota);
		if ($cekNull == true) {
			//jika masih ada yang kosong
			$data['warning_message'] = 'Profil Anda Belum Lengkap! Lengkapi Sekarang.';
		}

		$data['data_anggota'] = $this->m_anggota->get_detail_anggota($kode_anggota);
		$data['buku_dipinjam'] = $this->m_sirkulasi->get_dipinjam_byAnggota($kode_anggota);
		$data['buku_dikembalikan'] = $this->m_sirkulasi->get_dikembalikan_byAnggota($kode_anggota);
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');

		//menampilkan halaman berdasarkan hak akses admin/member
		if ($_SESSION['akses'] == 'admin') {
			$this->load->view('detailAnggota', $data);
		}else {
			$this->load->view('profile', $data);
		}
		$this->load->view('templates/footer');
	}

	public function searchData()
	{
		//fitur search anggota
        $keyword = $this->input->get('search');
        $data['data_anggota'] = $this->m_anggota->search($keyword);
        $this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
        $this->load->view('anggota', $data);
		$this->load->view('templates/footer');
    }

	public function displayFormEdit($kode_anggota)
	{
		//menampilkan form untuk mengedit data anggota
		$data['data_update'] = $this->m_anggota->get_detail_anggota($kode_anggota);
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
		$this->load->view('form/formEditAnggota', $data);
		$this->load->view('templates/footer');
	}

	public function displayChangePassword($kode_anggota)
	{
		//menampilkan form untuk mengganti password
		$data['data_anggota'] = $this->m_anggota->get_kode_email($kode_anggota);
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
		$this->load->view('form/formChangePass', $data);
		$this->load->view('templates/footer');
		
	}

	public function submitEdit()
	{
		// array untuk dimasukan ke dalam tabel anggota
		$kode = $this->input->post('kode_anggota');
		$data_anggota['nik'] = $this->input->post('nik');
		$data_anggota['alamat'] = $this->input->post('alamat');
		$data_anggota['no_telepon'] = $this->input->post('telepon');

		//cek apakah input email sudah pernah digunakan sebelumnya
		$cekInput = $this->m_anggota->cekField('email', $this->input->post('email'), $kode);
		if ($cekInput == false) {
			$this->form_validation->set_rules('email','Email','required|is_unique[tbl_anggota.email]');			//validasi email harus unique
			if ($this->form_validation->run() == true) {
				$data_anggota['email'] = $this->input->post('email');
				$old_email = $this->m_anggota->getOldEmail($kode);
				$res1 = $this->m_login->updateLogin($data_anggota['email'], $old_email);		//mengganti email di tabel login
				$res2 = $this->m_anggota->update($data_anggota, $kode);							//mengganti email di tabel anggota
				if ($res1 && $res2) {
					$this->session->set_flashdata('message', 'Update Data Berhasil!');
					redirect(base_url().'anggota/displayAnggotaDetail/'.$kode.'');
				}
				else {
					$this->session->set_flashdata('error_message', 'Update Data Gagal!');
					redirect(base_url().'anggota/displayFormEdit/'.$kode.'');
				}
			}
			else {
				$this->session->set_flashdata('error_message', 'Email Sudah Terdaftar Sebelumnya');
				redirect(base_url().'anggota/displayFormEdit/'.$kode.'');
			}
		}else {
			$res2 = $this->m_anggota->update($data_anggota, $kode);							//mengganti email di tabel anggota
			if ($res2) {
				$this->session->set_flashdata('message', 'Update Data Berhasil!');
				redirect(base_url().'anggota/displayAnggotaDetail/'.$kode.'');
			}
			else {
				$this->session->set_flashdata('error_message', 'Update Data Gagal!');
				redirect(base_url().'anggota/displayFormEdit/'.$kode.'');
			}
		}

	}

	public function submitDelete()
	{
		//mengambil kode delete dari form
		$kode_delete = $this->input->post('kode_anggota');

		//mengambil email berdasarkan kode anggota yang ingin di hapus
		$email = $this->m_anggota->getOldEmail($kode_delete);
		
		//hapus data anggota di tabel login dan anggota
		$res1 = $this->m_login->deleteLogin($email);
		$res2 = $this->m_anggota->delete($kode_delete);
		if ($res1 & $res2) {
			$this->session->set_flashdata('message', 'Hapus Data Berhasil!');
			redirect(base_url().'anggota/displayAnggota/');
		}
		else {
			$this->session->set_flashdata('error_message', 'Hapus Data Gagal!');
			redirect(base_url().'anggota/displayAnggota/');
		}
	}

	public function submitChangePass()
	{
		//validasi password
		$this->form_validation->set_rules('old_password','Old Password','required|min_length[8]|max_length[20]');
		$this->form_validation->set_rules('new_password','New Password','required|min_length[8]|max_length[20]');
		$this->form_validation->set_rules('validation_password','Validation Password','required|min_length[8]|max_length[20]');
		
		//mengambil input kode anggota dan email
		$kode_anggota = $this->input->post('kode_anggota');
		$email = $this->input->post('email');
		if ($this->form_validation->run() == true) {
			$old = md5($this->input->post('old_password'));									//menyamakan password lama dengan inputan
			$cekOldPass = $this->m_login->cekField('password', $old, $email);
			if ($cekOldPass) {
				//cek apakah validasi password benar
				if ($this->input->post('new_password') == $this->input->post('validation_password')) {
					//melakukan update password dengan input password baru
					$new_pass = md5($this->input->post('new_password'));
					$res = $this->m_login->updatePass($new_pass, $email);
					if ($res) {
						$this->session->set_flashdata('message', 'Ganti Password Berhasil!');
						redirect(base_url().'anggota/displayAnggotaDetail/'.$kode_anggota.'');
					}
					else {
						$this->session->set_flashdata('error_message', 'Ganti Pasword Gagal!');
						redirect(base_url().'anggota/displayChangePassword/'.$kode_anggota.'');
					}
				}else {
					$this->session->set_flashdata('error_message', 'Validasi Password Tidak Sesuai');
					redirect(base_url().'anggota/displayChangePassword/'.$kode_anggota.'');
				}
			}else {
				$this->session->set_flashdata('error_message', 'Password Sebelumnya Salah');
				redirect(base_url().'anggota/displayChangePassword/'.$kode_anggota.'');
			}
		}
		else {
			$this->session->set_flashdata('error_message', validation_errors());
			redirect(base_url().'anggota/displayChangePassword/'.$kode_anggota.'');
		}
	}
}
