<?php

namespace App\Framework;

class Response
{
    /**
     * The requested resource could not be found but may be available in the future.
     * @param array $errorInfo
     */
    public static function e404(array $errorInfo = []): void
    {
        $errorInfo["error"] = "The requested resource could not be found but may be available in the future.";
        header("Status: 404 Not Found", true, 404);
        if(!empty($errorInfo)) header("Body: " . json_encode($errorInfo));
        Page::error();
    }

    /**
     * The server cannot or will not process the request due to an apparent client error.
     * @param array $errorInfo
     */
    public static function e400(array $errorInfo = []): void
    {
        $errorInfo["error"] = "The server cannot or will not process the request due to an apparent client error.";
        header("Status: 400 Bad Request", true, 400);
        if(!empty($errorInfo)) header("Body: " . json_encode($errorInfo));
        Page::error();
    }

    /**
     * A request method is not supported for the requested resource.
     * @param array $errorInfo
     */
    public static function e405(array $errorInfo = []): void
    {
        $errorInfo["error"] = "A request method is not supported for the requested resource.";
        header("Status: 405 Method Not Allowed", true, 405);
        if(!empty($errorInfo)) header("Body: " . json_encode($errorInfo));
        Page::error();
    }

    /**
     * Indicates that the request could not be processed because of conflict in the current state of the resource.
     * @param array $errorInfo
     */
    public static function e409(array $errorInfo = []): void
    {
        $errorInfo["error"] = "Indicates that the request could not be processed because of conflict in the current state of the resource.";
        header("Status: 409 Conflict", true, 409);
        if(!empty($errorInfo)) header("Body: " . json_encode($errorInfo));
        Page::error();
    }
}