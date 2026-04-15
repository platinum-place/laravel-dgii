<?php

namespace PlatinumPlace\LaravelDgii\Tests\Unit;

use Illuminate\Support\Facades\Http;
use PlatinumPlace\LaravelDgii\Clients\DgiiClient;
use PlatinumPlace\LaravelDgii\Tests\TestCase;

class DgiiClientTest extends TestCase
{
    public function test_it_can_fetch_service_status(): void
    {
        Http::fake([
            'statusecf.dgii.gov.do/api/estatusservicios/obtenerestatus' => Http::response([
                'status' => 'online',
            ], 200),
        ]);

        $client = app(DgiiClient::class);
        $status = $client->fetchServiceStatus();

        $this->assertEquals(['status' => 'online'], $status);
    }

    public function test_it_can_fetch_auth_xml(): void
    {
        Http::fake([
            'ecf.dgii.gov.do/testecf/autenticacion/api/autenticacion/semilla' => Http::response('<xml>semilla</xml>', 200),
        ]);

        $client = app(DgiiClient::class);
        $xml = $client->fetchAuthXml();

        $this->assertEquals('<xml>semilla</xml>', $xml);
    }
}
