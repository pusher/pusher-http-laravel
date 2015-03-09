<?php

namespace Vinkla\Tests\Pusher;

use GrahamCampbell\TestBench\Traits\ServiceProviderTestCaseTrait;

class ServiceProviderTest extends AbstractTestCase
{

    use ServiceProviderTestCaseTrait;

    public function PusherFactoryIsInjectable()
    {
        $this->assertIsInjectable('Vinkla\Pusher\Factories\PusherFactory');
    }

    public function PusherManagerIsInjectable()
    {
        $this->assertIsInjectable('Vinkla\Pusher\PusherManager');
    }
}
