<?php

namespace OhDear\PhpSdk\Exceptions;

use Exception;
use Saloon\Http\Response;

class OhDearException extends Exception
{
    public function __construct(
        public Response $response,
        string $message,
        int $code,
    ) {
        parent::__construct($message, $code);
    }
}
