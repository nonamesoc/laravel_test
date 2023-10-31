<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\ComplaintRepositoryInterface;
use App\Models\Complaint;

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

}
