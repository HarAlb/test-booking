<?php

namespace Domain\Resource\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class ResourceNotFoundException extends HttpException
{
    public function __construct(string $message = 'Resource Not found', int $statusCode = 404, \Throwable $previous = null)
    {
        parent::__construct($statusCode,$message, $previous);
    }
}
