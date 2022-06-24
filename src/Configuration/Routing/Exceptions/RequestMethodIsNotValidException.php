<?php
declare(strict_types=1);

namespace App\Configuration\Routing\Exceptions;

use Exception;

class RequestMethodIsNotValidException extends Exception
{
    public function __construct(
        private string $method
    ) {
        $message = \sprintf(
            'Request method %s is not valid for this request',
            $this->method
        );

        parent::__construct($message);
    }

    public function getMethod(): string
    {
        return $this->method;
    }
}
