<?php

namespace PlatinumPlace\LaravelDgii\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/dgii.php', 'dgii');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'dgii');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/dgii.php' => config_path('dgii.php'),
            ], 'dgii-config');

            $this->publishes([
                __DIR__.'/../../resources/views' => resource_path('views/vendor/dgii'),
            ], 'dgii-views');
        }
    }
}
