<?php

namespace PlatinumPlace\LaravelDgii\Tests\Unit;

use Illuminate\Support\Facades\Cache;
use Mockery;
use PlatinumPlace\LaravelDgii\Actions\AuthenticateAction;
use PlatinumPlace\LaravelDgii\Actions\Seed\ReceiveSeedAction;
use PlatinumPlace\LaravelDgii\Clients\SeedClient;
use PlatinumPlace\LaravelDgii\Support\StorageService;
use PlatinumPlace\LaravelDgii\Support\XmlSigner;
use PlatinumPlace\LaravelDgii\Tests\TestCase;

class AuthenticateActionTest extends TestCase
{
    public function test_it_can_authenticate_and_cache_token()
    {
        $mockSeedClient = Mockery::mock(SeedClient::class);
        $mockXmlSigner = Mockery::mock(XmlSigner::class);
        $mockStorageService = Mockery::mock(StorageService::class);
        $mockReceiveSeedAction = Mockery::mock(ReceiveSeedAction::class);

        $mockSeedClient->shouldReceive('fetch')->once()->andReturn('<xml>seed</xml>');
        $mockXmlSigner->shouldReceive('sign')->once()->andReturn('<xml>signed</xml>');
        $mockReceiveSeedAction->shouldReceive('handle')->once()->andReturn([
            'token' => 'test-token',
            'expira' => date('Y-m-d H:i:s', strtotime('+1 hour')),
        ]);

        $action = new AuthenticateAction(
            $mockSeedClient,
            $mockXmlSigner,
            $mockStorageService,
            $mockReceiveSeedAction
        );

        Cache::shouldReceive('get')->once()->andReturn(null);
        Cache::shouldReceive('put')->once();

        $token = $action->handle();

        $this->assertEquals('test-token', $token);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
