<?php

namespace PlatinumPlace\LaravelDgii\Tests\Unit;

use Mockery;
use PlatinumPlace\LaravelDgii\Actions\ValidateCertAction;
use PlatinumPlace\LaravelDgii\Support\XmlSigner;
use PlatinumPlace\LaravelDgii\Tests\TestCase;

class ValidateCertActionTest extends TestCase
{
    public function test_it_can_validate_a_certificate()
    {
        $mockXmlSigner = Mockery::mock(XmlSigner::class);
        $mockXmlSigner->shouldReceive('validateCertificate')
            ->once()
            ->with('path/to/cert.p12', 'password')
            ->andReturn(['subject' => 'test']);

        $action = new ValidateCertAction($mockXmlSigner);
        $result = $action->handle('path/to/cert.p12', 'password');

        $this->assertEquals(['subject' => 'test'], $result);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
