<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Paste;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PastePolicy
{

    /**
     * Determine whether the user can view paste.
     *
     * @param \App\Models\User|null $user
     * @param \App\Models\Paste $paste
     *
     * @return bool
     */
    public function view(?User $user, Paste $paste): bool
    {
        return $paste->access !== 'private' || $user?->id === $paste->user_id;
    }

}
