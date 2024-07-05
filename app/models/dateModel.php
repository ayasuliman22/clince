<?php

class dateModel {

    private $db ;
    private $table = "dates" ;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function get ($id) {
        return $this->db->where("id" , $id)->getOne($this->table);
    }
    public function getAll () {
        return $this->db->get($this->table);
    }
    public function getDatesByDate ($date) {
        return $this->db->where("date" , $date)->get($this->table);
    }


}