<?php

namespace Domain\Booking\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class BookingPeriodConflictException extends HttpException
{
    public function __construct(string $message = 'Booking conflict: The user already has a booking in the selected period.', int $statusCode = 409, \Throwable $previous = null)
    {
        parent::__construct($statusCode, $message, $previous);
    }
}
