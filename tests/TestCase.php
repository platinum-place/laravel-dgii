<?php

namespace PlatinumPlace\LaravelDgii\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use PlatinumPlace\LaravelDgii\Providers\AppServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            AppServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('dgii.environment', 'testecf');
        $app['config']->set('dgii.api_key', 'test-api-key');
    }
}
