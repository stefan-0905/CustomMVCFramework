<?php

namespace GradeSystem\Models;

class Response
{
    public static function e404(array $errorInfo = []): void
    {
        header("Status: 404 Not Found", true, 404);
        if(!empty($errorInfo)) header("Body: " . json_encode($errorInfo));
        //require_once "./views/Errors/NotFound.php";
        Page::error();
    }

    public static function e400(array $errorInfo = []): void
    {
        header("Status: 400 Bad Request", true, 400);
        if(!empty($errorInfo)) header("Body: " . json_encode($errorInfo));
        Page::error();
    }
}