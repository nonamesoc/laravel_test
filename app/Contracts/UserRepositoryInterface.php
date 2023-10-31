<?php

namespace App\Contracts;

use App\Models\User;

interface UserRepositoryInterface
{

    /**
     * Create user to the database.
     *
     * @param array<mixed> $attributes
     *
     * @return \App\Models\User
     */
    public function createUser(array $attributes): User;

}
