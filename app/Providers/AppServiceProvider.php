<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repository\UserRepositoryInterface',
            'App\Repository\UserRepository'
        );

        $this->app->bind(
            'App\Repository\UserAssigmentRepositoryInterface',
            'App\Repository\UserAssigmentRepository'
        );

        $this->app->bind(
            'App\Repository\ChatRepositoryInterface',
            'App\Repository\ChatRepository'
        );

        $this->app->bind(
            'App\Repository\MessageRepositoryInterface',
            'App\Repository\MessageRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
