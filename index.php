<?php

require_once realpath("vendor/autoload.php");

use GradeSystem\Framework\Route;
use GradeSystem\Framework\Response;

require_once "routes.php";


try{
    if (!Route::exists()) {
        Response::e404(["message" => "This page does not exist."]);
    }

} catch (\GradeSystem\Models\Exceptions\MethodNotAllowedException $exception)
{
    Response::e405(["message" => $exception->getMessage()]);
} catch (Exception $exception)
{
    echo $exception->getMessage();
}




