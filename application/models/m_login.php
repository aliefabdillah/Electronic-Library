<?php

class M_login extends CI_Model{
    // cek data user di table login
    public function cek_login($email, $password)
    {
        return $this->db->query("SELECT * FROM `tbl_login` WHERE `email`='$email' AND `password`='$password' LIMIT 1");
    }

    public function cekField($field, $data, $email=null)
    {
        $this->db->select($field);
        $this->db->from('tbl_login');
        $this->db->where($field, $data);
        $this->db->where('email', $email);

        $data = $this->db->get()->row();
        if($data != null){
            return true;
        }else {
            return false;
        }
    }

    public function updateLogin($email, $old_email)
    {
        $this->db->set('email', $email);
        $this->db->where('email', $old_email);
        return $this->db->update('tbl_login');
    }
    
    public function updatePass($new_pass, $email)
    {
        $this->db->set('password', $new_pass);
        $this->db->where('email', $email);
        return $this->db->update('tbl_login');
    }

    public function deleteLogin($email)
    {
        return $this->db->delete('tbl_login', array("email" => $email));
    }

    public function getKodeAnggota($email)
    {
        return $this->db->query("SELECT `kode_anggota` FROM `tbl_anggota` WHERE `email`='$email' LIMIT 1");
    }

    public function getPassword($email)
    {
        $this->db->select('password');
        $this->db->from('tbl_login');
        $this->db->where('email', $email);
        return $this->db->get()->row()->password;
    }
} 

?>