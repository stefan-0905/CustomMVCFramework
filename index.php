<?php

require_once realpath("vendor/autoload.php");

use GradeSystem\Framework\Route;
use GradeSystem\Framework\Response;

require_once "routes.php";


if (!Route::exists()) {
    Response::e404(["message" => "This page does not exist."]);
}




