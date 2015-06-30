<?php

/*
 * This file is part of Laravel Pusher.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Tests\Pusher;

use GrahamCampbell\TestBenchCore\ServiceProviderTrait;

/**
 * This is the service provider test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testPusherFactoryIsInjectable()
    {
        $this->assertIsInjectable('Vinkla\Pusher\PusherFactory');
    }

    public function testPusherManagerIsInjectable()
    {
        $this->assertIsInjectable('Vinkla\Pusher\PusherManager');
    }
}
