<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\ComplaintRepositoryInterface;
use App\Models\Complaint;
use Illuminate\Database\Eloquent\Collection;

class ComplaintRepository implements ComplaintRepositoryInterface
{

    /**
     * {@inheritDoc}
     */
    public function createComplaint(array $attributes): Complaint
    {
        $complaint = Complaint::create($attributes);

        return $complaint;
    }

    /**
     * {@inheritDoc}
     */
    public function findAll(): Collection
    {
        return Complaint::all();
    }

}
