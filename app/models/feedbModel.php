<?php
// namespace app\models;

class feedbModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function getfeedByIdDoc($id) {
        return $this->db->where('id_doctoe', $id)->get('feedbacks',null,'feedback');
    } 
    public function getidPats() {
        return $this->db->get('feedbacks',null,"id_patuent");
    }
    public function getiddocs() {
        return $this->db->get('feedbacks',null,"id_doctoe");
    }
    public function addfeedback($data) {
        return $this->db->insert('feedbacks', $data);
    }
    public function updatef($data){
        return $this->db->update('feedbacks',$data);
    }
}