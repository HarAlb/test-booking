<?php

namespace Application\Auth\UseCases;

use Application\Auth\DTO\LoginResponse;
use Application\User\DTO\UserResponse;
use Domain\Auth\Exceptions\InvalidCredentialsException;
use Domain\Auth\Services\AuthTokenServiceInterface;
use Domain\User\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class LoginUseCase
{
    public function __construct(
        private UserRepositoryInterface $repository,
        private AuthTokenServiceInterface $authTokenService
    ) {
    }

    public function execute(string $email, string $password): LoginResponse
    {
        $user = $this->repository->findByEmail($email);

        if (!$user || !Hash::check($password, $user->getPassword())) {
            throw new InvalidCredentialsException();
        }

        return new LoginResponse(
            new UserResponse($user->getId(), $user->getName(), $user->getEmail()),
            $this->authTokenService->generateToken($user)
        );
    }
}
