<?php

namespace Domain\Auth\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class InvalidCredentialsException extends HttpException
{
    public function __construct(string $message = 'Login or password not correct', int $statusCode = 401, \Throwable $previous = null)
    {
        parent::__construct($statusCode, $message, $previous);
    }
}
