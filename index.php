<?php

require_once realpath("vendor/autoload.php");

use App\Framework\Route;
use App\Framework\Response;

require_once "routes.php";


try{
    if (!Route::exists()) {
        Response::e404(["message" => "This page does not exist."]);
    }

} catch (\App\Models\Exceptions\MethodNotAllowedException $exception)
{
    Response::e405(["message" => $exception->getMessage()]);
} catch (Exception $exception)
{
    echo $exception->getMessage();
}




