<?php

namespace App\Providers;

use App\Repositories\Implementations\PlayerRepository;
use App\Repositories\Interfaces\PlayerRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\NotificationRepository;
use App\Services\NotificationService;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind the repository and service
        $this->app->singleton(NotificationRepository::class);
        $this->app->singleton(NotificationService::class, function ($app) {
            return new NotificationService($app->make(NotificationRepository::class));
        });

        $this->app->bind(
            \App\Repositories\Interfaces\TeamRepositoryInterface::class,
            \App\Repositories\Implementations\TeamRepository::class
        );
        $this->app->bind(PlayerRepositoryInterface::class, PlayerRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
