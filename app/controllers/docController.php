<?php

require __DIR__ . "/../models/docModel.php";
require __DIR__ . "/../helper/validation.php";
class docController
{
    private $docModel;
    public function __construct($db)
    {
        $this->docModel = new docModel($db);
    }

    use validation;

    private function jsonR($data)
    {
        header("Content-Type: application/json");
        echo json_encode($data);
    }

    public function addDoc()
    {
        $data = [
            "name" => $_POST['name'],
            "id_spe" => $_POST["id_spe"]
        ];
        if ($this->validate_username($data["name"])) {
            if ($this->docModel->addDoc($data)) {
                $this->jsonR(["message" => "doctor add susseccfuly"]);
            } else {
                $this->jsonR(["message" => "There is something wrong"]);
            }
        } else {
            $this->jsonR(["message" => "Your data is"]);
        }
    }
}