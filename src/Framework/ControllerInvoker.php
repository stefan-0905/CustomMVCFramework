<?php

namespace GradeSystem\Framework;

use GradeSystem\Models\Exceptions\ClassNotFoundException;

class ControllerInvoker
{
    public static function invoke(string $controllerName, string $functionName) : void
    {
        try
        {
            if(class_exists($controllerName))
            {
                $controller = (new \ReflectionClass($controllerName))->newInstance();

                $result = call_user_func(array($controller, $functionName));

                if(!($result instanceof Page))
                {
                    echo $result;
                }

            } else
            {
                throw new ClassNotFoundException($controllerName);
            }

        } catch (\Exception $exception)
        {
            echo $exception->getMessage();
        }
    }
}