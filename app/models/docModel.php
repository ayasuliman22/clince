<?php
class docModel
{
    private $db;
    private $table = "doctors" ;


    /**
     * get all the doctors : getAll()
     * get one doctors by if : getDoctor() 
     */


    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getDoctor($id)
    {

        $doc = $this->db->where("id", $id)->getOne($this->table);

        return $doc;
    }
    
    public function getAll() {
        $doc = $this->db->get("doctors");
        
        return $doc;
    }

    public function addDoc ($data) {
        return $this->db->insert($this->table,$data);
    }

}
