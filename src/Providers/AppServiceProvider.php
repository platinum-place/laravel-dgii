<?php

namespace PlatinumPlace\LaravelDgii\Providers;

use Illuminate\Support\ServiceProvider;
use PlatinumPlace\LaravelDgii\Clients\CancellationRangeClient;
use PlatinumPlace\LaravelDgii\Clients\CommercialApprovalClient;
use PlatinumPlace\LaravelDgii\Clients\ConsumeInvoiceClient;
use PlatinumPlace\LaravelDgii\Clients\DgiiClient;
use PlatinumPlace\LaravelDgii\Clients\InvoiceClient;
use PlatinumPlace\LaravelDgii\Clients\SeedClient;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;
use PlatinumPlace\LaravelDgii\Support\XmlSigner;

class AppServiceProvider extends ServiceProvider
{
    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        /**
         * Clients
         */
        DgiiClient::class,
        SeedClient::class,
        InvoiceClient::class,
        ConsumeInvoiceClient::class,
        CommercialApprovalClient::class,
        CancellationRangeClient::class,

        /**
         * Support
         */
        StorageRepository::class,
        XmlSigner::class,
    ];

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
