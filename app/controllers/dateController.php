<?php
require_once __DIR__ . "/../models/dateModel.php";
require_once __DIR__ . "/../models/docModel.php";
require_once __DIR__ . "/../models/patModel.php";

class dateController
{
    private $date;
    private $pat;
    private $doc;

    public function __construct($db)
    {
        $this->date = new dateModel($db);
        $this->doc = new docModel($db);
        $this->pat = new patModel($db);
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
            foreach ($dates as $k => $v) :
            $data[] = [
                "id" => $v['id'],
                "id_doctor" => $v['id_doctor'],
                "id_patuent" => $v["id_patuent"],
                "doctor" => $this->doc->getDoctor($v["id_doctor"])["name"],
                "patuent" =>  $this->pat->getPatById($v["id_patuent"])["name"],
                "date" => "2024-07-05",
                "state" => ["the patuent didn't came to thte date", "the patuent came to the date"][$v['state']]
            ];
            endforeach ;
            $this->jsonR($data);
        } else {
            $this->jsonR(["message" => "There are no dates for today"]);
        }
    }
}