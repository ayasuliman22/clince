<?php
require_once __DIR__ . "/../models/adminModel.php";
class adminController
{
    private $admin;
    public function __construct($db)
    {
        $this->admin = new adminModel($db);
    }


    public function jsonR($data)
    {
        header("Content-Type: application/json");

        echo json_encode($data);
    }

    public function login()
    {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $isExist  = $this->admin->getAdminByEmail($email);
        if ($isExist) {
            if ($password == $isExist["password"]) {
                $this->jsonR(["message" => "Your data is correct"]);
            } else {
                $this->jsonR(["message" => "Your password is incorrect"]);
            }
        } else {
            $this->jsonR(["message" => "This email is not exist"]);
        }
    }
}
