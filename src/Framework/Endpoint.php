<?php

namespace GradeSystem\Framework;

class Endpoint
{
    public string $path;
    public array $segments = array();
    public array $parameters = array();

    public function __construct(string $path)
    {
        $this->path = $path;


        if(strpos($path, "/") == 0)
        {
            $this->path = substr($path, 1);
        }
//
//        echo $path ."<br>";
//        echo $this->path ."<br><br><br>";
        $this->segments = explode("/", $this->path);
    }

    public function compare(Endpoint $endpoint) : bool
    {
        if(count($this->segments) != count($endpoint->segments)) return false;

        foreach ($this->segments as $index => $segment)
        {
            if(str_contains($segment, "{"))
            {
                $parameter = str_replace("{", "", $segment);
                $parameter = str_replace("}", "", $parameter);

                $endpoint->parameters[$parameter] = $endpoint->segments[$index];

                continue;
            }

//        print_r($this->segments); echo "<br>";
//        print_r($endpoint->segments); echo "<br><br>";
            if($segment != $endpoint->segments[$index])
            {
                return false;
            }
        }

        return true;
    }
}
