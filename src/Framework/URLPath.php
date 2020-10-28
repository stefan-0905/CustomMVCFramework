<?php

namespace App\Framework;

class URLPath
{
    // Url name
    public string $name;
    // Url segments
    public array $segments;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->segments = $this->createSegments();
    }

    /**
     * Get current URL path
     *
     * @return URLPath
     */
    public static function current() : URLPath
    {
        $path = strtolower($_SERVER["REQUEST_URI"]);

        $path = str_replace(".php", "", $path);

        if(str_contains($path, "?"))
        {
            $pos = strpos($path, '?');
            if($pos)
                $path = substr($path, 0, $pos);
        }

        return new URLPath($path);
    }

    /**
     * Create segments for this endpoint
     * @return array
     */
    public function createSegments() : array
    {
        $cleanPath = $this->name;

        if(strpos($cleanPath, "/") == 0)
        {
            $cleanPath = substr($cleanPath, 1);
        }

        return explode("/", $cleanPath);
    }
}