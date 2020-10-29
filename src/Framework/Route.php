<?php

namespace App\Framework;

use App\Models\Exceptions\MethodNotAllowedException;

class Route
{
    // Registered endpoint routes
    private static array $validRoutes = array();

    /**
     * Registers a route
     * @param string $route
     * @param string $callback
     * @param string $method
     */
    public static function set(string $route, string $callback, string $method) : void
    {
        $lowerCaseRoute = strtolower($route);
        $route = new Endpoint(new URLPath($lowerCaseRoute), $method, $callback);

        if (self::find($route)) {
            Response::e409();
            return;
        }

        self::$validRoutes[] = $route;
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
     * Find route in already registered routes
     * @param Endpoint $route
     * @return Endpoint|null
     */
    public static function find(Endpoint $route) : ?Endpoint
    {
        foreach(self::$validRoutes as $r) {
            if ($r->compare($route)) {
                return $r;
            }
        }

        return NULL;
    }

    /**
     * Check if current endpoint is registered. If so, return it
     * @return Endpoint|null
     * @throws MethodNotAllowedException
     */
    public static function exists() : ?Endpoint
    {
        $isRouteWithDifferentRequestMethod = false;

        foreach(self::$validRoutes as $route) {
            if ($route->compare(Endpoint::getCurrent()))
            {
                // Route exists with same request method
                return $route;
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
            return NULL;
        }
    }
}