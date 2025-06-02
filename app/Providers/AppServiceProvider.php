<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(\App\Services\DeepLService::class, function ($app) {
            return new \App\Services\DeepLService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Inertia::share([
            'locale' => fn() => app()->getLocale(),
        ]);
    }
    protected $policies = [
        \App\Models\User::class => \App\Policies\UserPolicy::class,
    ];
}
