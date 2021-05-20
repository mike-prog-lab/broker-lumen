<?php

namespace App\Providers;

use App\Repositories\Outer\UserRepository;
use App\Services\UserService;
use GuzzleHttp\ClientInterface;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

/**
 * Class UserServiceProvider
 * @package App\Providers
 */
class UserServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepository::class, function () {
            return new UserRepository(env('AUTH_ROOT'), $this->app->make(ClientInterface::class));
        });

        $this->app->bind(UserService::class, function () {
            return new UserService($this->app->make(UserRepository::class));
        });

    }

    public function boot(): void
    {
        //
    }
}
