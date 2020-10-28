<?php

namespace App\Framework;

use App\Models\Exceptions\ClassNotFoundException;

class ControllerInvoker
{
    public static function invoke(string $controllerName, string $functionName, array $params = array()) : void
    {
        try
        {
            if(class_exists($controllerName))
            {
                $controller = (new \ReflectionClass($controllerName))->newInstance();

                if(!method_exists($controller, $functionName))
                    throw new \Exception("Specified method \"$functionName\" doesn't exist in this controller \"$controllerName\".");

                $result = call_user_func_array(array($controller, $functionName), $params);

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