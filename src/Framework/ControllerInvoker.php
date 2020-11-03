<?php

namespace App\Framework;

class ControllerInvoker
{
    public static function invoke(string $controllerName, string $functionName, array $params = array()) : void
    {
        try {
            if (class_exists($controllerName)) {
                $controller = (new \ReflectionClass($controllerName))->newInstance();

                if (!method_exists($controller, $functionName))
                {
                    Response::e404(["message" => "Specified method \"$functionName\" doesn't exist in this controller \"$controllerName\"."]);
                    return;
                }

                $result = call_user_func_array(array($controller, $functionName), $params);

                if ($result instanceof Page) {
                    return;
                }

                echo json_encode($result);

            } else {
                Response::e404(["message" => "There is no class defined with this name $controllerName"]);
                return;
            }
        } catch (\ReflectionException $exception)
        {
            Response::e404(["message" => "There is no class defined with this name $controllerName"]);
            return;
        }
    }
}