<?php

namespace App\Providers;

use App\Repositories\Interfaces\SocialiteRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\SocialiteRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(SocialiteRepositoryInterface::class, SocialiteRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
