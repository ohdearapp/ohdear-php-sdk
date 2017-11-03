<?php

namespace OhDear\PhpSdk\Exceptions;

use Exception;

class TimeoutException extends Exception
{
    public $output;

    public function __construct(array $output)
    {
        parent::__construct('Script timed out while waiting for the process to complete.');

        $this->output = $output;
    }
}
