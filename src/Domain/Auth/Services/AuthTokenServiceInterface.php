<?php

namespace Domain\Auth\Services;

use Domain\User\Entities\User;

interface AuthTokenServiceInterface
{
    public function generateToken(User $user): string;
}
