<?php 
require __DIR__ . "/../models/resModel.php" ;
class resController {

    private $db ;
    public function __construct($db)
    {
        $this->db = new resModel($db) ;
    }
 
    public function add ($id) {
        
    }
    public function show ($id) {
        
    }
}