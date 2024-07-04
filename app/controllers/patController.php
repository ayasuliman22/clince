<?php
require __DIR__.'/../models/patModel.php';
class PatController {
    private $model;
  
    public function __construct($db) {
      
        $this->model = new patModel($db);
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

            if ($this->model->addpat($data)) {
                // header('Location:' . BASE_PATH);
                header("content-type: application/json");
                $a = ['message' => 'added successfully'];
                echo json_encode($a);
            } else {
                echo "Failed to add pat.";
            }
        }
    }

    public function showpats() {
        $pats = $this->model->getpats();
        // include '../views/user_list.php';
        echo json_encode($pats); 


    }
    public function searchpatrs($searchTerm) {
        $pats = $this->model->searchpats($searchTerm);
        // include '../views/user_list.php';
        echo json_encode($pats); 

    }
    public function oneuser($id){
        $pat=$this->model->getpatById($id);
        header("content-type: application/json");
        echo json_encode($pat); 
    }

}