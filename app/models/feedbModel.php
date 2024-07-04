<?php
// namespace app\models;

class feedbModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function getfeedByIdDoc($id) {
        return $this->db->where('id_doctoe', $id)->get('feedbacks','feedback');
    } 
    public function addfeedback($data) {
        return $this->db->insert('feedbacks', $data);
    }
}