<?php

namespace Infrastructure\Auth\Services;

use Domain\Auth\Services\AuthTokenServiceInterface;
use Domain\User\Entities\User as UserEntity;
use Infrastructure\User\Models\User as EloquentUser;

class AuthTokenService implements AuthTokenServiceInterface
{
    public function generateToken(UserEntity $user): string
    {
        $eloquentUser = EloquentUser::where('email', $user->getEmail())->firstOrFail();

        return $eloquentUser->createToken('api-token')->plainTextToken;
    }
}
