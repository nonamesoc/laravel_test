<?php

declare(strict_types=1);

namespace App\View\Composers;

use App\Contracts\PasteRepositoryInterface;
use Illuminate\View\View;

class RecentPastes
{
    /**
     * Create class.
     *
     * @param \App\Contracts\PasteRepositoryInterface $pasteRepository
     */
    public function __construct(private PasteRepositoryInterface $pasteRepository)
    {
    }

    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     */
    public function compose(View $view): void
    {
        $view->with('pastes', $this->pasteRepository->getRecentPastes());
    }
}
