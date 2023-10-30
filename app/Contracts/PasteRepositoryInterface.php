<?php

namespace App\Contracts;

use App\Models\Paste;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface PasteRepositoryInterface
{

    /**
     * Create paste to the database.
     *
     * @param array<mixed> $attributes
     *
     * @return \App\Models\Paste
     */
    public function createPaste(array $attributes): Paste;

    /**
     * Find paste by uri attribute.
     *
     * @param string $uri
     *
     * @return \App\Models\Paste|null
     */
    public function findByUri(string $uri): ?Paste;

    /**
     * Get recent public pastes.
     *
     * @param int $limit
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, Paste>
     */
    public function getRecentPastes(int $limit = 10): Collection;

    /**
     * Get recent user pastes.
     *
     * @param int $user_id
     * @param int $limit
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, Paste>
     */
    public function getRecentPastesByUser(int $user_id, int $limit = 10): Collection;

    /**
     * Get user pastes with pagination.
     *
     * @param int $user_id
     * @param int $limit
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator<Paste>
     */
    public function getPastesPaginationByUser(int $user_id, int $limit = 10): LengthAwarePaginator;

}
