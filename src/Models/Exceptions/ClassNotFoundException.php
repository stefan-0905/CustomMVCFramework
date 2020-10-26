<?php

namespace GradeSystem\Models\Exceptions;

use Throwable;

class ClassNotFoundException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        $msg = "We couldn't find this class " . $message;
        parent::__construct($msg, $code, $previous);
    }
}