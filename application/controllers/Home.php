<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		//memanggil data biblio
		$data['data_biblio'] = $this->m_buku->get_biblio(); 
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
		$this->load->view('buku', $data);
		$this->load->view('templates/footer');
	}

	public function displayFormEdit($id_biblio)
	{
		//menampilkan form edit data biblio
		$data['data_biblio'] = $this->m_buku->get_biblioById($id_biblio);
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
		$this->load->view('form/formEditBiblio', $data);
		$this->load->view('templates/footer');
	}

	public function searchData()
	{
		//fitu search biblio
        $keyword = $this->input->get('search');
        $field = $this->input->get('searchBy');
		if ($keyword == null && $field == null) {
			redirect(base_url().'home/index/');
		}else {
			if ($field == null) {
				$this->session->set_flashdata('error_message', 'Kategori Pencarian Harus Diisi!');
				redirect(base_url().'home/index/');
			}else if($keyword == null) {
				$this->session->set_flashdata('error_message', 'Kata Kunci Pencarian Harus Diisi!');
				redirect(base_url().'home/index/');
			}else {
				$data['data_biblio'] = $this->m_buku->search($keyword, $field);
			}
			
		}
        
        $this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
        $this->load->view('buku', $data);
		$this->load->view('templates/footer');
    }

	// callback function
	public function customAlpha($str) 
	{
		//callback function untuk mengecek apakah nama pengarang hanya boleh huruf
		if ( !preg_match("/^[a-z .,\-]+$/i",$str) )
		{
			$this->form_validation->set_message('customAlpha', 'The %s field is not valid!');	
			return false;
		}else {
			return true;
		}
	}

	public function submitAdd()
	{
		//validation input data biblio
		$this->form_validation->set_rules('judul','Judul','required|max_length[255]');
		$this->form_validation->set_rules('kode_buku','Kode Buku','required|is_unique[tbl_biblio.kode_buku]|max_length[25]');
		$this->form_validation->set_rules('pengarang','Pengarang','required|callback_customAlpha');
		$this->form_validation->set_rules('penerbit','Penerbit','required|max_length[100]');
		$this->form_validation->set_rules('thn_terbit','Tahun Terbit','required');
		$this->form_validation->set_rules('bahasa','Bahasa','required|max_length[20]');
		$this->form_validation->set_rules('isbn','ISBN','required|max_length[50]|is_unique[tbl_biblio.isbn]');
		$this->form_validation->set_rules('kategori','Kategori','required|max_length[50]');
		$this->form_validation->set_rules('copy','Jumlah Copy','required');

		if ($this->form_validation->run() == true) 
		{
			//mengambil data input biblio
			$data_biblio['id_biblio'] = $this->m_buku->createIdBiblio();		//melakukan auto generate id biblio
			$data_biblio['judul'] = $this->input->post('judul');
			$data_biblio['kode_buku'] = $this->input->post('kode_buku');
			$data_biblio['pengarang'] = $this->input->post('pengarang');
			$data_biblio['penerbit'] = $this->input->post('penerbit');
			$data_biblio['thn_terbit'] = $this->input->post('thn_terbit');
			$data_biblio['bahasa'] = $this->input->post('bahasa');
			$data_biblio['isbn'] = $this->input->post('isbn');
			$data_biblio['jmlh_buku'] = $this->input->post('copy');
			$data_biblio['kategori'] = $this->input->post('kategori');

			$upload = $this->m_buku->uploadImg();								//mengambil foto dan melakukan validasi foto biblio

			if ($upload['result'] == "success") {			
				$data_biblio['foto'] = $upload['file']['file_name'];

				$res = $this->m_buku->add($data_biblio);
				if ($res) {
					$this->session->set_flashdata('message', 'Tambah Data Berhasil!');
					redirect(base_url().'home/index/');
				}
				else {
					$this->session->set_flashdata('error_message', 'Tambah Data Gagal!');
					redirect(base_url().'home/index/');
				}
			}
			else {
				$this->session->set_flashdata('error_message', $upload['error']);
				redirect(base_url().'home/index/');
			}
			
		}else {
			$this->session->set_flashdata('error_message', validation_errors());
			redirect(base_url().'home/index/');
		}
	}

	public function submitEdit()
	{
		$id_biblio = $this->input->post('id_biblio');
		$data_biblio['judul'] = $this->input->post('judul');
		
		// check apakah ada perubahan pada form kode_buku
		$cekInput = $this->m_buku->cekField('kode_buku', $this->input->post('kode_buku'), $id_biblio);
		if ($cekInput == false) {
			$this->form_validation->set_rules('kode_buku','Kode Buku','required|is_unique[tbl_biblio.kode_buku]|max_length[25]');
			if ($this->form_validation->run() == true) {
				$data_biblio['kode_buku'] = $this->input->post('kode_buku');
			}
			else {
				$this->session->set_flashdata('error_message', validation_errors());
				redirect(base_url().'home/displayFormEdit/'.$id_biblio.'');
			}
		}

		$data_biblio['pengarang'] = $this->input->post('pengarang');
		$data_biblio['penerbit'] = $this->input->post('penerbit');
		$data_biblio['thn_terbit'] = $this->input->post('thn_terbit');
		$data_biblio['bahasa'] = $this->input->post('bahasa');
		
		// check apakah ada perubahan pada form isbn
		$cekInput = $this->m_buku->cekField('isbn', $this->input->post('isbn'), $id_biblio);
		if ($cekInput == false) {
			$this->form_validation->set_rules('isbn','ISBN','required|max_length[50]|is_unique[tbl_biblio.isbn]');
			if ($this->form_validation->run() == true) {
				$data_biblio['isbn'] = $this->input->post('isbn');
			}
			else {
				$this->session->set_flashdata('error_message', validation_errors());
				redirect(base_url().'home/displayFormEdit/'.$id_biblio.'');
			}
		}

		$data_biblio['jmlh_buku'] = $this->input->post('copy');
		$data_biblio['kategori'] = $this->input->post('kategori');
	
		$upload = $this->m_buku->uploadImg();
		//jika foto tidak null/ada perubahan foto
		if ($upload['file'] != null) {
			if ($upload['result'] == "success") {			
				$data_biblio['foto'] = $upload['file']['file_name'];
	
				$data = $this->m_buku->getFoto($id_biblio);
				unlink("images/".$data);
			}
			else {
				$this->session->set_flashdata('error_message', $upload['error']);
				redirect(base_url().'home/displayFormEdit/'.$id_biblio.'');
			}	
		}


		$res = $this->m_buku->update($data_biblio, $id_biblio);
		if ($res) {
			$this->session->set_flashdata('message', 'Update Data Berhasil!');
			redirect(base_url().'home/index/');
		}
		else {
			$this->session->set_flashdata('error_message', 'Update Data Gagal!');
			redirect(base_url().'home/displayFormEdit/'.$id_biblio.'');
		}
	}

	public function submitDelete()
	{
		// menyimpan data id_biblio dari form
		$id_biblio = $this->input->post('id_biblio');
		
		// mengambil nama foto dari tabel database
		$foto = $this->m_buku->getFoto($id_biblio);
		
		$res = $this->m_buku->delete($id_biblio);

		if ($res) {
			//menghapus foto dari storage
			unlink("images/".$foto);
			
			$this->session->set_flashdata('message', 'Hapus Data Berhasil!');
			redirect(base_url().'home/index/');
		}
		else {
			$this->session->set_flashdata('error_message', 'Hapus Data Gagal!');
			redirect(base_url().'home/index/');
		}
	}
}
