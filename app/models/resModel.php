<?php


class resModel
{
    private $db;
    private $table = "results";

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function get($id)
    {
        return $this->db->where("id_date", $id)->getOne($this->table);
    }
}