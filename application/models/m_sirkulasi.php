<?php

class M_sirkulasi extends CI_Model{
    public function get_sirkulasi()
    {
        $this->db->select('*');
        $this->db->from('tbl_sirkulasi');
        $this->db->order_by("status", "desc");
        $this->db->join('tbl_anggota','tbl_sirkulasi.kode_anggota = tbl_anggota.kode_anggota','LEFT');
        $this->db->where('status !=', 'Request'); 
        $this->db->where('status !=', 'Not Accepted');
        return $this->db->get()->result_array();
        
        //        $query = "
        //         SELECT
        // 	tbl_anggota.kode_anggota, 
        // 	tbl_anggota.nama, 
        // 	tbl_sirkulasi.kode_transaksi, 
        // 	tbl_sirkulasi.judul, 
        // 	tbl_sirkulasi.tgl_pinjam, 
        // 	tbl_sirkulasi.tgl_kembali, 
        // 	tbl_sirkulasi.`status`, 
        // 	tbl_biblio.judul
        // FROM
        // 	tbl_anggota
        // 	INNER JOIN
        // 	tbl_sirkulasi
        // 	ON 
        // 		tbl_anggota.kode_anggota = tbl_sirkulasi.kode_anggota
        // 	INNER JOIN
        // 	tbl_biblio
        // 	INNER JOIN
        // 	tbl_koleksi
        // 	ON 
        // 		tbl_biblio.id_biblio = tbl_koleksi.id_biblio AND
        // 		tbl_sirkulasi.kode_koleksi = tbl_koleksi.kode_koleksi    ";
        // return $this->db->query($query);
        // print_r($this->db->query($query)->result_array());
        // exit(); 
    }

    public function get_request($id){
        $this->db->select('*');
        $this->db->from('tbl_sirkulasi');
        $this->db->order_by("status", "desc");
        $this->db->join('tbl_anggota','tbl_sirkulasi.kode_anggota = tbl_anggota.kode_anggota','LEFT');
        if ($_SESSION['akses'] == 'member') {
            $condition = "(tbl_sirkulasi.kode_anggota = '$id' AND status='Request') || (tbl_sirkulasi.kode_anggota = '$id' AND status='Not Accepted')";
            $this->db->where($condition); 
        }else {
            $this->db->where('status', 'Request');
        } 
        return $this->db->get()->result_array();
    }

    public function get_dipinjam_byAnggota($kode_anggota){
        $condition = array('kode_anggota' => $kode_anggota, 'status' => 'Dipinjam');

        $this->db->select('*');
        $this->db->from('tbl_sirkulasi');
        $this->db->where($condition);
        return $this->db->get()->result_array();
    }
    
    public function get_dikembalikan_byAnggota($kode_anggota){
        $condition = array('kode_anggota' => $kode_anggota, 'status' => 'Dikembalikan');

        $this->db->select('*');
        $this->db->from('tbl_sirkulasi');
        $this->db->where($condition);
        return $this->db->get()->result_array();
    }

    public function search($keyword=null){
        $this->db->select('*');
        $this->db->from('tbl_sirkulasi');
        $this->db->join('tbl_anggota','tbl_sirkulasi.kode_anggota = tbl_anggota.kode_anggota','LEFT');
        if (!empty($keyword)) {
            $this->db->like('kode_transaksi', $keyword);
            $this->db->or_like('nama', $keyword);
            $this->db->or_like('tgl_pinjam', $keyword);
        }

        return $this->db->get()->result_array();
    }

    public function createKodeTransaksi(){
        $this->db->select('RIGHT(tbl_sirkulasi.kode_transaksi,2) as kode_transaksi', FALSE);
        $this->db->order_by('kode_transaksi','DESC');
        $this->db->limit(1);
        $query = $this->db->get('tbl_sirkulasi');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode_transaksi) + 1;
        }
        else{
            $kode = 1;
        }

        $tgl=date('dmY'); 
        $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);    
        $kode = "TR"."-".$tgl."-".$batas;  //format kode
        return $kode;
    }

    public function add($data_input){
        return $this->db->insert('tbl_sirkulasi', $data_input);
    }

    public function delete($id)
    {
        return $this->db->delete('tbl_sirkulasi', array("id_peminjaman" => $id));
    }

    public function updateStatus($data, $id_peminjaman)
    {
        // $data = array('status' => $status);
        $this->db->where('id_peminjaman', $id_peminjaman);
        $this->db->update('tbl_sirkulasi', $data);
    }
} 

?>