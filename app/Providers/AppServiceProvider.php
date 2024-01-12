<?php

namespace App\Providers;

use App\Repositories\Interfaces\ILinkRepository;
use App\Repositories\LinkRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ILinkRepository::class, LinkRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
