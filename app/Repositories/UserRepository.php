<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{

    /**
     * {@inheritDoc}
     */
    public function createUser(array $attributes): User
    {
        return User::create($attributes);
    }

    /**
     * {@inheritDoc}
     */
    public function banUserById(int $id): bool
    {
        $user = User::find($id);
        if (!isset($user)) {
            return FALSE;
        }

        $user->banned = 1;
        $user->save();
        return TRUE;
    }

    /**
     * {@inheritDoc}
     */
    public function findAll(): Collection
    {
        return User::all();
    }

    /**
     * {@inheritDoc}
     */
    public function findUserByGoogleId(string $google_id): ?User
    {
        return User::where('google_id', $google_id)->first();
    }

}
