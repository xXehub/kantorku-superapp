<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        // Share authenticated user with role data to navbar component
        View::composer('components.navbar', function ($view) {
            if (auth()->check()) {
                $user = auth()->user()->load('role');
                $view->with('user', $user);
            }
        });
    }
}
