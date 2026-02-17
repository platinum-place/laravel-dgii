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
        $this->app->singleton(DgiiXmlService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'dgii');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/dgii.php' => config_path('dgii.php'),
            ], 'dgii-config');

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/dgii'),
            ], 'dgii-views');
        }
    }
}
