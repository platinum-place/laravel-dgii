<?php

namespace PlatinumPlace\LaravelDgii\Providers;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class HttpMacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Http::macro('dgiiEcf', function (?string $environment = null) {
            $env = $environment ?: config('dgii.environment');

            $baseUrl = config('dgii.domains.ecf');

            $finalUrl = rtrim($baseUrl, '/').'/'.ltrim($env, '/');

            return Http::baseUrl($finalUrl)
                ->throw();
        });

        Http::macro('dgiiFc', function (?string $environment = null) {
            $env = $environment ?: config('dgii.environment');

            $baseUrl = config('dgii.domains.fc');

            $finalUrl = rtrim($baseUrl, '/').'/'.ltrim($env, '/');

            return Http::baseUrl($finalUrl)
                ->throw();
        });

        Http::macro('dgiiStatusEcf', function () {
            return Http::baseUrl(config('dgii.domains.statusecf'))
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
