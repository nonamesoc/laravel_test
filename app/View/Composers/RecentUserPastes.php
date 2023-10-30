<?php

declare(strict_types=1);

namespace App\View\Composers;

use App\Contracts\PasteRepositoryInterface;
use Illuminate\View\View;

class RecentUserPastes
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
        if ($user_id = auth()->id()) {
            $view->with('pastes', $this->pasteRepository->getRecentPastesByUser($user_id));
        }
    }

}
