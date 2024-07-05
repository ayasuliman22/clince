<?php

class patModel {

    private $db ;
    private $table = "patuents" ;

    public function __construct($db) 
    {
        $this->db = $db;    
    }
    
    public function getPatById($id) {
        return $this->db->where("id" , $id) -> getOne($this->table);
    }
}