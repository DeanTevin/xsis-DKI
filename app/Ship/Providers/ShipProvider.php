<?php

namespace App\Ship\Providers;

use App\Ship\Parents\Providers\MainServiceProvider as ParentMainServiceProvider;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class ShipProvider extends ParentMainServiceProvider
{
    /**
     * Register any Service Providers on the Ship layer (including third party packages).
     */
    public array $serviceProviders = [
        EventServiceProvider::class,
        RouteServiceProvider::class,
    ];

    /**
     * Register any Alias on the Ship layer (including third party packages).
     */
    protected array $aliases = [];

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        parent::boot();
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
        RateLimiter::for('login', function ($request) {
            return RateLimiter::attempt(
                'login|' . Str::lower($request->input('username')),
                $maxAttempts = 3, // Max attempts allowed
                $decayMinutes = 1 // Lockout time in minutes
            );
        });
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        parent::register();

        /*
         * Load the ide-helper service provider only in non production environments.
         */
        if ($this->app->isLocal()) {
            $this->app->register(IdeHelperServiceProvider::class);
        }

        Config::macro('unset', function ($key) {
            Arr::forget($this->items, $key);
        });
    }
}
