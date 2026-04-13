<?php

namespace PlatinumPlace\LaravelDgii;

use Illuminate\Support\ServiceProvider;
use PlatinumPlace\LaravelDgii\Clients\DgiiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/dgii.php', 'dgii'
        );

        $this->app->singleton(DgiiClient::class);
        $this->app->singleton(DgiiXmlService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'dgii');
    }
}
