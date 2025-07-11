<?php

namespace Interfaces\Http\Controllers;

use App\Http\Controllers\Controller;
use Application\Auth\UseCases\LoginUseCase;
use Illuminate\Http\JsonResponse;
use Interfaces\Http\Requests\LoginRequest;
use OpenApi\Attributes as OAT;

class AuthController extends Controller
{
    #[OAT\Post(
        path: '/auth/login',
        operationId: 'login',
        summary: 'Login and get access token',
        requestBody: new OAT\RequestBody(ref: '#/components/requestBodies/LoginRequest'),
        tags: ['Auth'],
        responses: [
            new OAT\Response(
                response: 200,
                description: 'Login successful',
                content: new OAT\JsonContent(ref: '#/components/schemas/LoginResponse')
            ),
            new OAT\Response(
                response: 401,
                description: 'Invalid credentials',
                content: new OAT\JsonContent(
                    properties: [
                        new OAT\Property(property: 'error', type: 'string', example: 'Invalid credentials.')
                    ]
                )
            )
        ]
    )]
    public function login(LoginRequest $request, LoginUseCase $loginUseCase): JsonResponse
    {
        $data = $loginUseCase->execute(
            $request->get('email'),
            $request->get('password'),
        );

        return new JsonResponse($data);
    }
}
