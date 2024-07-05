<?php
require_once __DIR__ . "/../models/dateModel.php";

class dateController
{
    private $date;

    public function __construct($db)
    {
        $this->date = new dateModel($db);
    }

    public function jsonR($data)
    {
        header("Content-Type: application/json");

        echo json_encode($data);
    }

    public function todaysDates()
    {
        $dates = $this->date->getDatesByDate(date("Y-m-d"));
        if ($dates) {
            $this->jsonR($dates);
        } else {
            $this->jsonR(["message" => "something went wrong"]);
        }
    }
}
