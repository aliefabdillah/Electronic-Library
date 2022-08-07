<?php

class M_anggota extends CI_Model{
    public function get_anggota()
    {
        return $this->db->get('tbl_anggota')->result_array();
    }

    public function get_detail_anggota($kode_anggota)
    {
        $this->db->select('*');
        $this->db->from('tbl_anggota');
        $this->db->where('kode_anggota', $kode_anggota);
        return $this->db->get()->row();
    }

    public function getOldEmail($kode_anggota)
    {
        $this->db->select('email');
        $this->db->from('tbl_anggota');
        $this->db->where('kode_anggota', $kode_anggota);
        return $this->db->get()->row()->email;
    }

    public function get_kode_email($kode_anggota)
    {
        $this->db->select('kode_anggota, email');
        $this->db->from('tbl_anggota');
        $this->db->where('kode_anggota', $kode_anggota);
        return $this->db->get()->row_array();
    }

    public function cekField($field, $data, $kode=null)
    {
        $this->db->select($field);
        $this->db->from('tbl_anggota');
        $this->db->where($field, $data);
        if ($kode != null) {
            $this->db->where('kode_anggota', $kode);
        }

        $data = $this->db->get()->row();
        if($data != null){
            return true;
        }else {
            return false;
        }
    }

    public function cekFieldisNull($kode)
    {
        $this->db->select('*');
        $this->db->from('tbl_anggota');
        $this->db->where('kode_anggota', $kode);
        $data = $this->db->get()->row();
        // print_r($data->nik);
        if(($data->nik == null) || ($data->email == null) || ($data->alamat == null) || ($data->no_telepon == null)){
            return true;
        }else {
            return false;
        }
    }

    public function search($keyword=null){
        $this->db->select('*');
        $this->db->from('tbl_anggota');
        if (!empty($keyword)) {
            $this->db->like('kode_anggota', $keyword);
            $this->db->or_like('nik', $keyword);
            $this->db->or_like('nama', $keyword);
        }

        return $this->db->get()->result_array();
    }

    public function createKodeAnggota(){
        $this->db->select('RIGHT(tbl_anggota.kode_anggota,3) as kode_anggota', FALSE);
        $this->db->order_by('kode_anggota','DESC');
        $this->db->limit(1);
        $query = $this->db->get('tbl_anggota');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode_anggota) + 1;
        }
        else{
            $kode = 1;
        }

        $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);    
        $kodetampil = "MB".$batas;  //format kode
        return $kodetampil;
    }

    public function add($data_input){
        return $this->db->insert('tbl_anggota', $data_input);
    }

    public function update($data, $kode){
        $this->db->where('kode_anggota', $kode);
        return $this->db->update('tbl_anggota', $data);
    }

    public function delete($kode)
    {
        return $this->db->delete('tbl_anggota', array("kode_anggota" => $kode));
    }
} 

?>