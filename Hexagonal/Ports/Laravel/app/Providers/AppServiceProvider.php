<?php

namespace LaravelApp\Providers;

use Adapters\User\UserRepositoryAdapter;
use Domains\User\SignUpService;
use Illuminate\Support\ServiceProvider;
use LaravelApp\Repositories\UserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        App()->when(SignUpService::class)
            ->needs(UserRepositoryAdapter::class)
            ->give(UserRepository::class);
    }
}
