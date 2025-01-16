<?php

namespace LaravelApp\Providers;

use Ports\User\UserRepositoryPort;
use Domains\User\SignUpService;
use Domains\User\UserService;
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
            ->needs(UserRepositoryPort::class)
            ->give(UserRepository::class);

        App()->when(UserService::class)
            ->needs(UserRepositoryPort::class)
            ->give(UserRepository::class);
    }
}
