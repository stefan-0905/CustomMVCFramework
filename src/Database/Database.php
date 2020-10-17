<?php

namespace GradeSystem\Database;

use PDO;

class Database
{
    private static $instance = NULL;

    public static function connect()
    {
        if(!self::$instance)
        {
            self::$instance = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST, DB_USERNAME, DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        }
        return self::$instance;
    }
}