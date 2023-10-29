<?php

namespace App\Contracts;

use App\Models\Paste;

interface PasteRepositoryInterface
{

    /**
     * Create paste to the database.
     *
     * @param array<mixed> $attributes
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

}
