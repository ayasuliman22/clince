<?php
class specModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function addspec($data) {
        return $this->db->insert('specialties', $data);
    }
}