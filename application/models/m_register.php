<?php

class M_register extends CI_Model{

    public function add($data_input){
        return $this->db->insert('tbl_login', $data_input);
    }
} 

?>