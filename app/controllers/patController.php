<?php
require_once __DIR__.'/../models/patModel.php';
// require __DIR__ . "/../helper/validation.php";
class PatController {

    private $model;

    public function __construct($db) {
      
        $this->model = new patModel($db);
    }
    // use validation;

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
            // if ($this->validate_username($data["name"])) {
            if ($this->model->addpat($data)) {
                // header('Location:' . BASE_PATH);
                header("content-type: application/json");
                $a = ['message' => 'added successfully'];
                echo json_encode($a);
            } else {
                $a=['message'=>'Failed to add pat'];
                echo json_encode($a);
            }
        }
        // else{
        //   $a=['message '=>'uncorrect data'];
        //   echo json_encode($a);

        //  }

    // }
}

    public function showpats() {
        header("content-type: application/json");

        $pats = $this->model->getpats();
        // include '../views/user_list.php';
        echo json_encode($pats); 


    }
    public function searchpatrs($n
        
    ) { if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        // $s = [
            // 'name' => $name,];
        $pats = $this->model->searchpats($n);
        // include '../views/user_list.php';
        header("content-type: application/json");

        echo json_encode($pats); 
    }}
    public function onepat($id){
        
        $pat=$this->model->getpatById($id);
        header("content-type: application/json");
        echo json_encode($pat); 
    }}
