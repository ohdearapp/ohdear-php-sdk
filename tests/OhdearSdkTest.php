<?php

namespace OhDear\PhpSdk\Tests;

use OhDear\PhpSdk\OhDear;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /** @test */
    public function it_can_instantiate_an_object()
    {
        $sdk = new OhDear('api-token');

        $this->assertTrue(is_object($sdk));
    }

    /** @test */
    public function it_has_support_for_performance_records()
    {
        $sdk = new OhDear('api-token');

        $this->assertTrue(method_exists($sdk, 'performanceRecords'));
    }
}
