<?php
require_once __DIR__.'/../models/patModel.php';
require_once __DIR__ . "/../helper/validation.php";
class PatController {

    private $model;

    public function __construct($db) {
      
        $this->model = new patModel($db);
    }
    use validation;
    private function jsonR($data)
    {
        header("Content-Type: application/json");
        echo json_encode($data);
    }
    public function addpat()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $number = $_POST['number'];
            $date=$_POST['date'];
            $data = [
                'name' => $name,
                'number' => $number,
                'date' => $date,
            ];
            if ($this->validate_username($name)&&$this->validate_date($date)&& 
            $this->validate_phone($number)) {
                $numps=[];
                // global $id;
                $pat=$this->model->getPatsnum();
                foreach ($pat as $k) {
                     foreach ($k as $d => $f) {
                    array_push($numps,$f);
                     }}
                     if(!in_array($number,$numps)){
            if ($this->model->addpat($data)) {
                $a = ['message' => 'added successfully'];
      
            } else {
                $a=['message'=>'Failed to add pat'];
              
            }}
            else{
                $a=['message'=>'pat already exist'];
            }
          
        }
    else{$a=['message'=>'uncorrect data'];}
 }
 $this->jsonR($a);
    }
    public function showpats() {
        $pats = $this->model->getpats();
        $this->jsonR($pats);
    }
    public function searchpatrs($n)
     { if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $pats = $this->model->searchpats($n);
        $this->jsonR($pats);
    }}
    public function onepat($id){
        
        $pat=$this->model->getpatById($id);
       $this->jsonR($pat); 
    }
}