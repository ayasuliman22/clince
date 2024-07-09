<?php
require_once __DIR__ . '/../models/feedbModel.php';
require_once __DIR__ . '/../models/patModel.php';
class feedbController
{
    private $model;
    private $pat;

    public function __construct($db)
    {
        
        $this->model = new feedbModel($db);
    }
    private function jsonR($data)
    {
        header("Content-Type: application/json");
        echo json_encode($data);
    }
    public function addfeedb()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_doc = $_POST['id_doctoe'];
            $id_pat = $_POST['id_patuent'];
            $feedback = $_POST['feedback'];
            $data = [
                'id_doctoe' => $id_doc,
                'id_patuent' => $id_pat,
                'feedback' => $feedback,
            ];
            $idps=[];
            // global $id;
            $pat=$this->model->getidPats();
            foreach ($pat as $k) {
                 foreach ($k as $d => $f) {
                array_push($idps,$f);
                 }}
                 $idds=[];
                 // global $id;
                 $doc=$this->model->getiddocs();
                 foreach ($doc as $k) {
                      foreach ($k as $d => $f) {
                     array_push($idds,$f);
                      }}
            
                if(!in_array($id_pat,$idps)||!in_array($id_doc,$idds)){
            if ($this->model->addfeedback($data)) {
                $a = ['message' => 'added successfully'];
            } else {
                $a=['message' => "Failed to add feedback."];
            }
        }else {
            if ($this->model->updatef($data)) {
                $a = ['message' => 'update successfully'];
        }}
    }$this->jsonR($a);}
    public function getfeedbyIdDoc($id_doc)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sum = 0;
            $feed = $this->model->getfeedByIdDoc($id_doc);
            foreach ($feed as $k) {
                foreach ($k as $d => $f) {
                    $sum += $f;
                } }
            $count = count($feed);
            $av = $sum / $count;
            $m = ["feedb:"=> $av];
           $this->jsonR($m);
           
        }
    }
}