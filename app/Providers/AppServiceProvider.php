<?php

namespace App\Providers;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (!app()->runningInConsole()) {
            $users = app(UserRepository::class)->paginate();
            View::share('users', $users);
        }
    }
}
