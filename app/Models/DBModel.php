<?php

namespace App\Models;

use PDO;

class DBModel
{

    private $db;

    public function __construct()
    {
        $this->db = new PDO('sqlite:data.db');
    }

    public function findAll($table)
    {
        try {
            $stmt = $this->db->query("SELECT * FROM $table ORDER BY id DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function findPage($permalink)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM pages WHERE permalink = :permalink");
            $stmt->bindParam(':permalink', $permalink, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result === false) {
                return null;
            }

            return $result;
        } catch (\PDOException $e) {
            throw new \Exception("Error while fetching page: " . $e->getMessage());
        }
    }
}
