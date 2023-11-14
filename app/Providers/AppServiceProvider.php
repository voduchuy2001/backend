<?php

namespace App\Providers;

use App\Services\Interfaces\SocialiteServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Services\SocialiteService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(SocialiteServiceInterface::class, SocialiteService::class);
        $this->app->register(RepositoryServiceProvider::class);
    }

    public function boot(): void
    {
        //
    }
}
