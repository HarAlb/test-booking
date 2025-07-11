<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OAT;

#[
    OAT\Info(version: '1.0', title: 'Booking Project Documentation'),
    OAT\Server(url: L5_SWAGGER_CONST_HOST, description: 'API Server'),
    OAT\SecurityScheme(securityScheme: 'bearerAuth', type: 'http', scheme: 'bearer'),
]
abstract class Controller
{
    //
}
