<?php
require_once __DIR__.'/../models/specModel.php';
class specController {

    private $model;

    public function __construct($db) {
      
        $this->model = new specModel($db);}
        
        private function jsonR($data)
        {
            header("Content-Type: application/json");
            echo json_encode($data);
        }
        public function addspec()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $data=[
                'name'=>$name,
            ];
            if ($this->model->addspec($data)) {
                // header("content-type: application/json");
                $a = ['message' => 'added successfully'];
           
            } else {
                $a=['message'=>'Failed to add spec'];
            
            }
            $this->jsonR($a);  
        }
    }
    public function showallspec(){
         $sp=$this->model->showspec();
         $this->jsonR($sp);
    }
    }
   