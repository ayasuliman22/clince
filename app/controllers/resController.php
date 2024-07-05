<?php
require __DIR__ . "/../models/resModel.php";
require_once __DIR__ . "/../models/dateModel.php" ;
class resController
{
    private $res;
    private $date;

    public function __construct($db)
    {
        $this->res = new resModel($db);
        $this->date = new dateModel($db);
    }kk

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
                    "id_data" => $id,
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
            $data = $this->res->get($id);
            if ($data) {
                $this->jsonR($data);
            } else {
                $this->jsonR(["message" => "The result is not exist"]);
            }
        } else {
            $this->jsonR(["message" => "The date is not exist"]);
        }
    }
}
