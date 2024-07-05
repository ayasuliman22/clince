<?php
require_once __DIR__.'/../models/specModel.php';
class specController {

    private $model;

    public function __construct($db) {
      
        $this->model = new specModel($db);}
        public function addspec()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $data=[
                'name'=>$name,
            ];
            if ($this->model->addspec($data)) {
                // header('Location:' . BASE_PATH);
                header("content-type: application/json");
                $a = ['message' => 'added successfully'];
                echo json_encode($a);
            } else {
                $a=['message'=>'Failed to add spec'];
                echo json_encode($a);
            }
        }
    }
    }
   
