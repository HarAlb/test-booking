<?php

namespace Infrastructure\User\Repositories;

use Domain\User\Entities\User;
use Domain\User\Repositories\UserRepositoryInterface;
use Infrastructure\User\Models\User as UserModel;

class UserRepository implements UserRepositoryInterface
{
    public function findByEmail(string $email): ?User
    {
        $model = UserModel::where('email', $email)->first();

        if (!$model) {
            return null;
        }

        $userEntity = new User(
            name: $model->name,
            email: $model->email,
            password: $model->password
        );

        $userEntity->setId($model->id);

        return $userEntity;
    }
}
