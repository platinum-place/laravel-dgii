<?php

namespace PlatinumPlace\LaravelDgii\Tests;

use Illuminate\Contracts\Container\BindingResolutionException;
use Orchestra\Testbench\TestCase;
use PlatinumPlace\LaravelDgii\DgiiServiceProvider;
use PlatinumPlace\LaravelDgii\DgiiXmlService;

class XmlServiceTest extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            DgiiServiceProvider::class,
        ];
    }

    /**
     * @throws BindingResolutionException
     */
    public function test_it_can_render_ecf_31(): void
    {
        $service = $this->app->make(DgiiXmlService::class);
        
        $data = [
            'IdDoc' => [
                'TipoeCF' => '31',
                'eNCF' => 'E310000000001',
            ],
            'Emisor' => [
                'RNCEmisor' => '101000000',
                'RazonSocialEmisor' => 'Empresa de Prueba',
            ],
            'DetallesItems' => [], // Requerido por el blade
        ];

        $xml = $service->renderEcf('31', $data);

        $this->assertStringContainsString('<TipoeCF>31</TipoeCF>', $xml);
        $this->assertStringContainsString('<eNCF>E310000000001</eNCF>', $xml);
        $this->assertStringContainsString('<?xml version="1.0" encoding="utf-8"?>', $xml);
    }

    /**
     * @throws BindingResolutionException
     */
    public function test_it_can_render_anecf(): void
    {
        $service = $this->app->make(DgiiXmlService::class);
        
        $data = [
            'RncEmisor' => '101000000',
            'CantidadeNCFAnulados' => 1,
            'DetalleAnulacion' => [
                [
                    'NoLinea' => 1,
                    'TipoeCF' => '31',
                    'CantidadeNCFAnulados' => 1,
                    'TablaRangoSecuenciasAnuladaseNCF' => [
                        [
                            'SecuenciaeNCFDesde' => 'E310000000001',
                            'SecuenciaeNCFHasta' => 'E310000000001',
                        ]
                    ]
                ]
            ]
        ];

        $xml = $service->renderAnecf($data);
        
        $this->assertStringContainsString('<RncEmisor>101000000</RncEmisor>', $xml);
        $this->assertStringContainsString('<ANECF>', $xml);
    }

    /**
     * @throws BindingResolutionException
     */
    public function test_it_can_render_arecf(): void
    {
        $service = $this->app->make(DgiiXmlService::class);
        
        $data = [
            'RNCEmisor' => '101000000',
            'RNCComprador' => '101000001',
            'eNCF' => 'E310000000001',
            'Estado' => '0',
        ];

        $xml = $service->renderArecf($data);
        
        $this->assertStringContainsString('<RNCEmisor>101000000</RNCEmisor>', $xml);
        $this->assertStringContainsString('<RNCComprador>101000001</RNCComprador>', $xml);
        $this->assertStringContainsString('<eNCF>E310000000001</eNCF>', $xml);
        $this->assertStringContainsString('<ARECF>', $xml);
    }
}
