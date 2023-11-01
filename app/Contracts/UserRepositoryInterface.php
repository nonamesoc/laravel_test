<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

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

    /**
     * Ban user.
     *
     * @param int $id
     *
     * @return bool
     */
    public function banUserById(int $id): bool;

    /**
     * Get all records.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, User>
     */
    public function findAll(): Collection;

}
