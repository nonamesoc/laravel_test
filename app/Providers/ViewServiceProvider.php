<?php

declare(strict_types=1);

namespace App\Providers;

use App\View\Composers\RecentPastes;
use App\View\Composers\RecentUserPastes;
use Illuminate\Support\Facades\View as FacadeView;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // ...
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        FacadeView::composer('paste.recent-pastes', RecentPastes::class);
        FacadeView::composer('paste.recent-user-pastes', RecentUserPastes::class);
    }

}
