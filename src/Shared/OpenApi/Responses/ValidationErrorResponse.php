<?php

namespace Shared\OpenApi\Responses;

use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: 'ValidationErrorResponse',
    properties: [
        new OAT\Property(
            property: 'errors',
            type: 'object',
            example: [
                'start' => ['The start field is required.'],
                'end' => ['The end must be a valid date.']
            ]
        )
    ]
)]
class ValidationErrorResponse
{
}
