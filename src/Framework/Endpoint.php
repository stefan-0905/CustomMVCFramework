<?php

namespace App\Framework;

class Endpoint
{
    // Type of request - GET, POST, PUT...
    public string $method;
    // Url path
    public URLPath $path;
    // Parameters in path
    public array $parameters = array();
    // Current endpoint
    private static ?Endpoint $current = NULL;

    public function __construct(URLPath $path, string $method = "GET")
    {
        $this->path = $path;
        $this->method = $method;
    }

    public static function getCurrent() : Endpoint
    {
        if(self::$current == NULL) self::$current = new Endpoint(URLPath::current(), $_SERVER["REQUEST_METHOD"]);

        return self::$current;
    }

    public function compare(Endpoint $endpoint) : bool
    {
        return $this->compareBySegments($endpoint) && $this->compareByMethod($endpoint);
    }

    /**
     * Compare endpoints by their segments.
     * @param Endpoint $endpoint
     * @return bool
     */
    public function compareBySegments(Endpoint $endpoint) : bool
    {
        if(count($this->path->segments) != count($endpoint->path->segments)) return false;

        foreach ($this->path->segments as $index => $segment)
        {
            if(str_contains($segment, "{"))
            {
                $parameter = str_replace("{", "", $segment);
                $parameter = str_replace("}", "", $parameter);

                $endpoint->parameters[$parameter] = $endpoint->path->segments[$index];

                continue;
            }

            if($segment != $endpoint->path->segments[$index])
            {
                return false;
            }
        }

        return true;
    }

    /**
     * Compare endpoints by request method - GET, POST...
     * @param Endpoint $endpoint
     * @return bool
     */
    public function compareByMethod(Endpoint $endpoint) : bool
    {
        return $this->method == $endpoint->method;
    }
}
