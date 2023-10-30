<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\PasteRepositoryInterface;
use App\Enums\ExpireDate;
use App\Models\Paste;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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
        $current_date = Carbon::now();
        return Paste::where('uri', $uri)
            ->where(function (Builder $query) use($current_date) {
                $query->where('expire_date', '>=', $current_date)
                    ->orWhereNull('expire_date');
            })
            ->first();
    }

    /**
     * {@inheritDoc}
     */
    public function getRecentPastes(int $limit = 10): Collection
    {
        $current_date = Carbon::now();
        return Paste::where('access', 'public')
            ->where(function (Builder $query) use($current_date) {
                $query->where('expire_date', '>=', $current_date)
                    ->orWhereNull('expire_date');
            })
            ->orderByDesc('created_at')
            ->take($limit)
            ->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getRecentPastesByUser(int $user_id, int $limit = 10): Collection
    {
        $current_date = Carbon::now();
        return Paste::whereIn('access', ['public', 'private'])
            ->where('user_id', $user_id)
            ->where(function (Builder $query) use($current_date) {
                $query->where('expire_date', '>=', $current_date)
                    ->orWhereNull('expire_date');
            })
            ->orderByDesc('created_at')
            ->take($limit)
            ->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getPastesPaginationByUser(int $user_id, int $limit = 10): LengthAwarePaginator
    {
        $current_date = Carbon::now();
        return Paste::whereIn('access', ['public', 'private'])
            ->where('user_id', $user_id)
            ->where(function (Builder $query) use($current_date) {
                $query->where('expire_date', '>=', $current_date)
                    ->orWhereNull('expire_date');
            })
            ->paginate($limit);
    }

}
