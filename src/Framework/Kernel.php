<?php

namespace App\Framework;

use Exception;
use \App\Models\Exceptions\MethodNotAllowedException;

class Kernel
{
    public function handle() : void
    {
        try
        {
            if ($route = Route::exists())
            {
                $route->action();
            } else {
                Response::e404();
            }

        } catch (MethodNotAllowedException $exception)
        {
            Response::e405();
        } catch (Exception $exception)
        {
            echo $exception->getMessage();
        }
    }
}