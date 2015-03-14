<?php

namespace Vinkla\Tests\Pusher;

use GrahamCampbell\TestBench\Traits\ServiceProviderTestCaseTrait;

class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTestCaseTrait;

    public function testPusherFactoryIsInjectable()
    {
        $this->assertIsInjectable('Vinkla\Pusher\Factories\PusherFactory');
    }

    public function testPusherManagerIsInjectable()
    {
        $this->assertIsInjectable('Vinkla\Pusher\PusherManager');
    }
}
