<?php

class patModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getPats() {
        return $this->db->get('patuents');
    }
    public function addPat($data) {
        return $this->db->insert('patuents', $data);
    }
    public function getPatById($id) {
        return $this->db->where('id', $id)->getOne('patuents');
    }
    public function searchPats($searchTerm) {
        $this->db->where('name', $searchTerm, 'LIKE');
        return $this->db->get('patuents');
    }
    
}