<?php
require __DIR__.'/../models/feedbModel.php';
class feedbController {
    private $model;
  

    public function __construct($db) {
      
        $this->model = new feedbModel($db);
    }
    public function addfeedb()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_doc = $_POST['id_doctoe'];
            $id_pat = $_POST['id_patuent'];
            $feedback=$_POST['feedback'];
            $data = [
                'id_doctoe' => $id_doc,
                'id_patuent' => $id_pat,
                'feedback' => $feedback ,
            ];

            if ($this->model->addfeedback($data)) {
                // header('Location:' . BASE_PATH);
                header("content-type: application/json");
                $a = ['message' => 'added successfully'];
                echo json_encode($a);
            } else {
                echo "Failed to add user.";
            }
        }
      
    }
    public function getfeedbyIdDoc($id_doc){
        $feed=$this->model->getfeedByIdDoc($id_doc);      
    }
}