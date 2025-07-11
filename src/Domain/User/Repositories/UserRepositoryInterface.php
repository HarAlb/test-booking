<?php

namespace Domain\User\Repositories;

use Domain\User\Entities\User;

interface UserRepositoryInterface
{
    public function findByEmail(string $email): ?User;
}
