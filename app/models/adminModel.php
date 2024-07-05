<?php 

class adminModel {
    private $table = "admins" ; 
    private $db ;
    public function __construct($db)
    {
        $this->db = $db ;
    }

    public function getAdminByEmail ($email) {
        return $this->db->where("email" , $email)->getOne($this->table);
    }
}