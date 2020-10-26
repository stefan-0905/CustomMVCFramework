<?php

namespace GradeSystem\Database;

use \PDO;

class Database
{
    private const DB_HOST = 'localhost';
    private const DB_NAME = 'gradesystem';
    private const DB_USERNAME = 'root';
    private const DB_PASSWORD = '';

    private static ?PDO $instance = NULL;

    public static function connect(): PDO
    {
        if (!self::$instance) {
            self::$instance = new PDO('mysql:dbname=' . self::DB_NAME . ';host=' . self::DB_HOST, self::DB_USERNAME, self::DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        }
        return self::$instance;
    }
}