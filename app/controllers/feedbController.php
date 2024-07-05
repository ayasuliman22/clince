<?php
require_once __DIR__.'/../models/feedbModel.php';
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
                echo "Failed to add feedback.";
            }
        }
      
    }
    public function getfeedbyIdDoc($id_doc){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header("content-type: application/json");
        $sum=0;
        $feed=$this->model->getfeedByIdDoc($id_doc); 
foreach($feed as $k){
    foreach($k as $d=>$f){
             $sum +=$f;}}
             $count=count($feed);
             $av=$sum/$count;
echo json_encode($av);

            //  $a = ['message' => 'added successfully'];
            // $av=$sum/$count;

            //  echo json_encode($av);
    }
    }
}