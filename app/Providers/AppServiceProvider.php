<?php

namespace App\Providers;

use App\Contracts\ComplaintRepositoryInterface;
use App\Contracts\PasteRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use App\Repositories\ComplaintRepository;
use App\Repositories\PasteRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            PasteRepositoryInterface::class,
            PasteRepository::class
        );
        $this->app->bind(
            ComplaintRepositoryInterface::class,
            ComplaintRepository::class
        );
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
