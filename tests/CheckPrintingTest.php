<?php

namespace BrianZaballa\CheckPrinting\Tests;

use BrianZaballa\CheckPrinting\Check;
use BrianZaballa\CheckPrinting\CheckPrintingServiceProvider;
use BrianZaballa\CheckPrinting\Facades\CheckPrinting;
use Orchestra\Testbench\TestCase;

class CheckPrintingTest extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [CheckPrintingServiceProvider::class];
    }

    public function test_generates_pdf(): void
    {
        $check = new Check('Jane Doe', '1234.50', '1001', new \DateTimeImmutable('2026-01-15'), 'Invoice 42');

        $this->assertStringContainsString('Jane Doe', CheckPrinting::html($check));
        $this->assertStringStartsWith('%PDF', CheckPrinting::pdf($check));
    }
}
