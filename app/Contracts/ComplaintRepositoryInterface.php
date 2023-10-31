<?php

namespace App\Contracts;

use App\Models\Complaint;

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

}
