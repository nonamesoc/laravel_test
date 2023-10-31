<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{

    /**
     * {@inheritDoc}
     */
    public function createUser(array $attributes): User
    {
        return User::create($attributes);
    }

}
