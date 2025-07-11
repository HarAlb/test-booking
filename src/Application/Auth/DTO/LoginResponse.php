<?php

namespace Application\Auth\DTO;

use Application\User\DTO\UserResponse;
use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: 'LoginResponse',
    required: ['user', 'token']
)]
class LoginResponse implements \JsonSerializable
{
    public function __construct(
        #[OAT\Property(ref: '#/components/schemas/UserResponse')]
        private UserResponse $user,

        #[OAT\Property(type: 'string', example: 'eyJ0eXAiOiJKV1Qi...')]
        private string $token
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'user' => $this->user,
            'token' => $this->token,
        ];
    }
}
