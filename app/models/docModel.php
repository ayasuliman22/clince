<?php
class docModel
{
    private $db;


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

        $doc = $this->db->where("id", $id)->get("doctors");

        return $doc;
    }
    
    public function getAll() {
        $doc = $this->db->get("doctors");
        
        return $doc;
    }

}
