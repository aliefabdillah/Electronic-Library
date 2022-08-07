<?php

class M_koleksi extends CI_Model{

    public function get_koleksi($id_biblio)
    {
        $this->db->select('*');
        $this->db->from('tbl_koleksi');
        $this->db->where('tbl_koleksi.id_biblio', $id_biblio);
        $this->db->order_by('kode_koleksi','ASC');
        $this->db->join('tbl_biblio','tbl_koleksi.id_biblio = tbl_biblio.id_biblio','LEFT');      
        return $this->db->get()->result_array();
    }

    public function get_koleksiById($id_koleksi)
    {
        $this->db->select('*');
        $this->db->from('tbl_koleksi');
        $this->db->where('id_koleksi', $id_koleksi);
        $this->db->join('tbl_biblio','tbl_koleksi.id_biblio = tbl_biblio.id_biblio','LEFT');      
        return $this->db->get()->row();
    }

    public function get_foto_judul($id_biblio)
    {
        $this->db->select('id_biblio, foto, judul');
        $this->db->from('tbl_biblio');
        $this->db->where('tbl_biblio.id_biblio', $id_biblio);
        return $this->db->get()->row_array();
    }

    public function cekField($field, $data, $id=null)
    {
        $this->db->select($field);
        $this->db->from('tbl_koleksi');
        $this->db->where($field, $data);
        if ($id != null) {
            $this->db->where('id_koleksi', $id);
        }

        $data = $this->db->get()->row();
        if($data != null){
            return true;
        }else {
            return false;
        }
    }

    public function createKodeKoleksi(){
        $this->db->select('RIGHT(kode_koleksi,3) as kode_koleksi');
        $this->db->from('tbl_koleksi');
        $this->db->like('kode_koleksi', 'KOL');
        $this->db->order_by('kode_koleksi','DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode_koleksi) + 1;
        }
        else{
            $kode = 1;
        }

        $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);    
        $kodetampil = "KOL".$batas;  //format kode
        return $kodetampil;
    }

    public function add($data){
        return $this->db->insert('tbl_koleksi', $data);
    }

    public function update($data, $id){
        $this->db->where('id_koleksi', $id);
        return $this->db->update('tbl_koleksi', $data);
    }


    public function delete($id)
    {
        return $this->db->delete('tbl_koleksi', array("id_koleksi" => $id));
    }

    public function updateStatus($status, $kode_koleksi)
    {
        $data = array('status' => $status);
        $this->db->where('kode_koleksi', $kode_koleksi);
        $this->db->update('tbl_koleksi', $data);
    }
} 

?>