<?php
require_once __DIR__ . "/../models/dateModel.php";
require_once __DIR__ . "/../models/docModel.php";
require_once __DIR__ . "/../models/patModel.php";
require_once __DIR__ . "/../helper/validation.php";

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

    use validation;

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
            endforeach;
            $this->jsonR($data);
        } else {
            $this->jsonR(["message" => "there are no dates for today"]);
        }
    }


    public function setDate()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") :
            $data = [
                "id_doctor" => $_POST["id_doctor"],
                "id_patuent" => $_POST["id_patuent"],
                "date" => $_POST["date"],
                "time" => $_POST["time"],
                "state" => $_POST["state"]
            ];

            if ($this->validate_date_table($data)) {
                $dateByDoctor = $this->date->ddToday($data["id_doctor"], $data["date"]);
                if ($dateByDoctor) {
                    if ($this->isDoctorHaveTime($data["time"], $dateByDoctor)) {
                    } else {
                        if ($this->date->setDate($data)) {
                            echo 'dfd';
                            $this->jsonR(["message" => "Done"]);
                        } else {
                            $this->jsonR(["message" => "Done"]);
                        }
                    }
                } else {
                    if ($this->date->setDate($data)) {
                        echo 'sdasdasd';
                        $this->jsonR(["message" => "Done"]);
                    } else {

                        $this->jsonR(["message" => "Something went wrong"]);
                    }
                }
            } else {
                $this->jsonR(["message" => "your data is incorrect"]);
            }


        endif;
    }


    public function getAll()
    {
        return $this->date->getTime();
    }
}
