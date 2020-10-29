<?php

namespace App\Framework;

class PagePathFinder
{
    /**
     * Generates the path by looking in the backtrace for controller name and appending $page to it.
     * @param string $page
     * @return string
     */
    public static function byControllerName(string $page) : string
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
}