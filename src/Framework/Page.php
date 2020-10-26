<?php

namespace GradeSystem\Framework;

class Page
{
    /**
     * Page constructor.Should be used only in controllers because it forms a path
     * based of controller name.
     *
     * @param string $page
     * @param array $data
     */
    public function __construct(string $page = "Index", array $data = array())
    {
        foreach($data as $key => $value)
        {
            $$key = $value;
        }

        $destination = $this->generatePagePath($page);

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
     * Generates the path by looking in the backtrace for controller name and appending $page to it
     *
     * @param string $page
     * @return string
     */
    private function generatePagePath(string $page) : string
    {
        $path = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS	)[1]["file"];

        $path = explode('\\', $path);
        $controller = array_pop($path);

        $controller = str_replace(".php", "", $controller);
        $folder = str_replace("Controller", "", $controller);
        $folder .= "/";

        if($folder == "Home/") $folder = "";

        return "./views/" . $folder . $page .".php";
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