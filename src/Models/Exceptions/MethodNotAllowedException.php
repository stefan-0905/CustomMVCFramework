<?php

namespace GradeSystem\Models\Exceptions;

use Throwable;

class MethodNotAllowedException extends \Exception
{
    public function __construct(string $message = "A request method is not supported for the requested resource.", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}