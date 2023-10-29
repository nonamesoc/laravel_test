<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\PasteRepositoryInterface;
use App\Enums\ExpireDate;
use App\Models\Paste;

class PasteRepository implements PasteRepositoryInterface
{

    /**
     * {@inheritDoc}
     */
    public function createPaste(array $attributes): Paste
    {
        $attributes['expire_date'] = ExpireDate::from($attributes['expire_date'])->date();
        $attributes['uri'] = bin2hex(random_bytes(4));
        $paste = Paste::create($attributes);
        $value = $paste->id . ($paste->user_id ?? 0);
        $paste->uri = substr(md5($value), 0, 9);
        $paste->save();

        return $paste;
    }

    /**
     * {@inheritDoc}
     */
    public function findByUri(string $uri): ?Paste
    {
        return Paste::where('uri', $uri)->first();
    }
}
