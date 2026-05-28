<?php

namespace PlatinumPlace\LaravelDgii\Providers;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class HttpMacroServiceProvider extends ServiceProvider
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
        Http::macro('dgiiInvoice', static function (string $env) {
            $baseUrl = config('dgii.domains.invoice');

            $finalUrl = rtrim($baseUrl, '/').'/'.ltrim($env, '/');

            return Http::baseUrl($finalUrl)
                ->throw();
        });

        Http::macro('dgiiConsumerInvoice', static function (string $env) {
            $baseUrl = config('dgii.domains.consumer_invoice');

            $finalUrl = rtrim($baseUrl, '/').'/'.ltrim($env, '/');

            return Http::baseUrl($finalUrl)
                ->throw();
        });

        Http::macro('dgiiStatus', static function () {
            return Http::baseUrl(config('dgii.domains.status'))
                ->withHeaders([
                    'accept' => '*/*',
                    'Authorization' => 'Apikey '.config('dgii.api_key'),
                ])
                ->throw();
        });

        PendingRequest::macro('attachXml', function (string $physicalPath) {
            return $this->attach('xml', fopen($physicalPath, 'rb'), basename($physicalPath));
        });
    }
}
