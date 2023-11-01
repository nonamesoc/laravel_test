<?php

namespace App\Contracts;

use App\Models\Complaint;
use Illuminate\Database\Eloquent\Collection;

interface ComplaintRepositoryInterface
{

    /**
     * Create complaint to the database.
     *
     * @param array<mixed> $attributes
     *
     * @return \App\Models\Complaint
     */
    public function createComplaint(array $attributes): Complaint;

    /**
     * Get all records.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, Complaint>
     */
    public function findAll(): Collection;

}
