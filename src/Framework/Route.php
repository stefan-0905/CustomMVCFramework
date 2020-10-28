<?php

namespace App\Framework;

use App\Models\Exceptions\MethodNotAllowedException;

class Route
{
    // Registered endpoint routes
    private static array $validRoutes = array();

    // Is current path invoked
    private static bool $invoked = false;

    /**
     * Registers a route
     *
     * @param string $route
     * @param string $callback
     * @param string $method
     */
    public static function set(string $route, string $callback, string $method) : void
    {
        $lowerCaseRoute = strtolower($route);
        $route = new Endpoint(new URLPath($lowerCaseRoute), $method);

        self::$validRoutes[] = $route;

        self::action($route, $callback);
    }

    /**
     * Action needed to happen on desired route
     *
     * @param Endpoint $route
     * @param string $callback
     */
    private static function action(Endpoint $route, string $callback) : void
    {
        if($route->compare(Endpoint::getCurrent()) && !self::$invoked)
        {
            // First param is namespace of controller, and second is function on that controller
            $params = explode("@", $callback);
            ControllerInvoker::invoke($params[0], $params[1], Endpoint::getCurrent()->parameters);
            self::$invoked = true;
        }
    }

    public static function get(string $route, string $callback) : void
    {
        self::set($route, $callback, "GET");
    }

    public static function post(string $route, string $callback) : void
    {
        self::set($route, $callback, "POST");
    }

    public static function put(string $route, string $callback) : void
    {
        self::set($route, $callback, "PUT");
    }

    public static function patch(string $route, string $callback) : void
    {
        self::set($route, $callback, "PATCH");
    }

    public static function delete(string $route, string $callback) : void
    {
        self::set($route, $callback, "DELETE");
    }

    /**
     * @return bool
     * @throws MethodNotAllowedException
     */
    public static function exists() : bool
    {
        $isRouteWithDifferentRequestMethod = false;

        foreach(self::$validRoutes as $route) {
            if ($route->compare(Endpoint::getCurrent()))
            {
                // Route exists with same request method
                return true;
            }
            if($route->compareBySegments(Endpoint::getCurrent()) && !$route->compareByMethod(Endpoint::getCurrent()))
            {
                // Route exists but with different request method
                $isRouteWithDifferentRequestMethod = true;
            }
        }

        if($isRouteWithDifferentRequestMethod)
        {
            // If it's not empty it means we have route with same path but different request method
            throw new MethodNotAllowedException();
        }
        else {
            // Route doesn't exist
            return false;
        }
    }
}