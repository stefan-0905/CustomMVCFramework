<?php

namespace GradeSystem;

use GradeSystem\Models\ControllerInvoker;

class Route
{
    private static array $validRoutes = array();

    /**
     * Checks to see if current page is valid i.e. is register in our route array
     * @return bool
     */
    public static function exists() : bool
    {
        return in_array(self::getPath(), self::$validRoutes, TRUE);
    }

    /**
     * Registers a route
     *
     * @param string $route
     * @param string $callback
     */
    public static function set(string $route, string $callback) : void
    {
        $lowerRoute = strtolower($route);
        self::$validRoutes[] = $lowerRoute;

        $path = self::getPath();

//        echo $path . " ";echo $route; echo "<br>";

        if($path == $lowerRoute || $path == ($lowerRoute . "/"))
        {
            // First param is namespace of controller, and second is function on that controller
            $params = explode("@", $callback);
            ControllerInvoker::invoke($params[0], $params[1]);
        }

    }

    /**
     * Extract path from uri
     *
     * @return string
     */
    private static function getPath() : string
    {
        $path = strtolower($_SERVER["REQUEST_URI"]);
//        $path = str_replace("", "", $uri);
        $path = str_replace(".php", "", $path);

        if(str_contains($path, "?"))
        {
            $pos = strpos($path, '?');
            if($pos)
                $path = substr($path, 0, $pos);
        }

        return $path;
    }
}