<?php

require_once realpath("vendor/autoload.php");

define('DB_HOST', 'localhost');
define('DB_NAME', 'gradesystem');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

echo "Hello";

$repo = new \GradeSystem\Database\StudentRepository();
$repo->findById(1);

