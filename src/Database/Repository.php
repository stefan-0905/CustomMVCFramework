<?php

namespace App\Database;

use PDO;

class Repository
{
    protected PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

}