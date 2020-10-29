<?php

namespace App\Framework;

class Page
{
    /**
     * Page constructor.Should be used only in controllers because it forms a path
     * based of controller name.
     * @param string $page
     * @param array $data
     */
    public function __construct(string $page = "Index", array $data = array())
    {
        foreach($data as $key => $value)
        {
            $$key = $value;
        }

        $destination = PagePathFinder::byControllerName($page);

        if(file_exists($destination))
        {
            require_once "./views/_layouts/front.php";
        }
        else {
            header("Status: 404 Not Found", true, 404);
            header("Body: " . json_encode(["message" => "File for this page does not exist."]));
            self::error();
        }
    }

    /**
     * Requires an Error page
     */
    public static function error() : void
    {
        $title = "Error";
        $destination = "./views/Errors/NotFound.php";
        require_once "./views/_layouts/front.php";

    }
}