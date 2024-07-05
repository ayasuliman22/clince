<?php
require __DIR__ . "/../models/resModel.php";
require_once __DIR__ . "/../models/dateModel.php" ;
require_once __DIR__ . "/../models/patModel.php" ;
require_once __DIR__ . "/../models/docModel.php" ;

class resController
{
    private $res;
    private $date;
    private $doctor;
    private $pat;

    public function __construct($db)
    {
        $this->res = new resModel($db);
        $this->date = new dateModel($db);
        $this->doctor = new docModel($db);
        $this->pat = new patModel($db);
    }

    private function jsonR($data)
    {
        header("Content-Type: application/json");
        echo json_encode($data);
    }

    public function add($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") :
            /**
             * I need get date by id from Anas
             * From dateModel
             */
            $date = $this->date->get($id);
            if ($date) {
                $data = [
                    "id_date" => $id,
                    "result" => $_POST["result"]
                ];
                if ($this->res->insert($data)) {
                    $this->jsonR(["message" => "Done"]);
                } else {
                    $this->jsonR(["message" => "ERROR"]);
                }
            } else {
                $this->jsonR(["message" => "The date is not exist"]);
            }
        endif;
    }
    public function show($id)
    {
        $date = $this->date->get($id);
        if ($date) {
            $res = $this->res->get($id);
            if ($res) {
                $data = [
                    "id" => $res["id"] ,
                    "id_date" => $res["id_date"] ,
                    "id_doctor" =>  $this->doctor->getDoctor($date["id_doctor"])['name'],
                    "id_patent" =>  $this->pat->getPatById($date["id_patuent"])['name'],
                    "result" => $res["result"]
                ];
                $this->jsonR($data);
            } else {
                $this->jsonR(["message" => "The result is not exist"]);
            }
        } else {
            $this->jsonR(["message" => "The date is not exist"]);
        }
    }
}
