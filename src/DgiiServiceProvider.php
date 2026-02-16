<?php

namespace PlatinumPlace\LaravelDgii;

use Illuminate\Support\ServiceProvider;

class DgiiServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/dgii.php', 'dgii'
        );

        $this->app->singleton(DgiiService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/dgii.php' => config_path('dgii.php'),
            ], 'dgii-config');
        }
    }
}
