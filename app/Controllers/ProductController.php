<?php

namespace App\Controllers;

use App\Models\DBModel;

class ProductController
{

    private $DB;

    public function __construct()
    {
        $this->DB = new DBModel();
    }

    public function store()
    {
        echo json_encode($this->DB->findAll('articles'));
    }
}
