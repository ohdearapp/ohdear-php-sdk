<?php

namespace OhDear\PhpSdk\Exceptions;

use Exception;

class ValidationException extends Exception
{
    public $errors = [];

    public function __construct(array $errors)
    {
        parent::__construct('The given data failed to pass validation.');

        $this->errors = $errors;
    }
}