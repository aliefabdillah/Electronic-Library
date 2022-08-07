<?php

class M_buku extends CI_Model{
    public function get_biblio()
    {
        $this->db->select('*');
        $this->db->from('tbl_biblio');
        $this->db->order_by('judul', 'asc');
        return $this->db->get()->result_array();
    }

    public function get_biblioById($id_biblio)
    {
        $this->db->select('*');
        $this->db->from('tbl_biblio');
        $this->db->where('id_biblio', $id_biblio);     
        return $this->db->get()->row();
    }

    public function getFoto($id_biblio)
    {
        $this->db->select('foto');
        $this->db->from('tbl_biblio');
        $this->db->where('tbl_biblio.id_biblio', $id_biblio);
        return $this->db->get()->row()->foto;
    }

    public function cekField($field, $data, $id=null)
    {
        $this->db->select($field);
        $this->db->from('tbl_biblio');
        $this->db->where($field, $data);
        if ($id != null) {
            $this->db->where('id_biblio', $id);
        }

        $data = $this->db->get()->row();
        if($data != null){
            return true;
        }else {
            return false;
        }
    }

    public function search($keyword, $field){
        $this->db->select('*');
        $this->db->from('tbl_biblio');
        $this->db->like($field, $keyword);
        $this->db->order_by('judul', 'asc');

        return $this->db->get()->result_array();
    }

    public function createIdBiblio(){
        $this->db->select('RIGHT(tbl_biblio.id_biblio,3) as id_biblio', FALSE);
        $this->db->order_by('id_biblio','DESC');
        $this->db->limit(1);
        $query = $this->db->get('tbl_biblio');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->id_biblio) + 1;
        }
        else{
            $kode = 1;
        }

        $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);    
        $kodetampil = "BBL".$batas;  //format kode
        return $kodetampil;
    }

    public function uploadImg()
    {
        $config['upload_path'] = './images/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '2048';
        $config['remove_space'] = TRUE;
        $this->load->library('upload', $config); // Load konfigurasi uploadnya
        if($this->upload->do_upload('foto')){ // Lakukan upload dan Cek jika proses upload berhasil
            // Jika berhasil :
            $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
            return $return;
        }else{
            // Jika gagal :
            $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
            return $return;
        }
    }
    public function add($data){
        return $this->db->insert('tbl_biblio', $data);
    }

    public function update($data, $id){

        $this->db->where('id_biblio', $id);
        return $this->db->update('tbl_biblio', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('tbl_biblio', array("id_biblio" => $id));
    }
} 

?>