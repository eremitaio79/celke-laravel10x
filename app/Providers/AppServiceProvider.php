<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        /* PAGINAÇÃO */
        Paginator::useBootstrapFive(); // Para Bootstrap 5
        // Paginator::useBootstrap(); // For Bootstrap 5
        // Paginator::useBootstrapFour(); // For Bootstrap 4
        // Paginator::useBootstrapThree(); // For Bootstrap 3

        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });
    }
}
