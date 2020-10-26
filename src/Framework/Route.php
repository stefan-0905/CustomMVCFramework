<?php

namespace GradeSystem\Framework;

class Route
{
    private static array $validRoutes = array();

    private static bool $invoked = false;

    /**
     * Checks to see if current page is valid i.e. is register in our route array
     * @return bool
     */
    public static function exists() : bool
    {
        $currentRoute = new Endpoint(self::getPath());
        foreach(self::$validRoutes as $route)
        {
            if($route->compare($currentRoute)) return true;
        }
        return false;
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
        //echo $lowerRoute . "||";
        $route = new Endpoint($lowerRoute);
        self::$validRoutes[] = $route;

        $path = self::getPath();
        $currentRoute = new Endpoint($path);

//        echo $route->path . "   " . $currentRoute->path . "<br>";

        if($route->compare($currentRoute) && !self::$invoked)
        {
            // First param is namespace of controller, and second is function on that controller
            $params = explode("@", $callback);
            ControllerInvoker::invoke($params[0], $params[1], $currentRoute->parameters);

            self::$invoked = true;
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