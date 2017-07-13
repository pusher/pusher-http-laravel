<?php

/*
 * This file is part of Laravel Pusher.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Vinkla\Tests\Pusher;

use GrahamCampbell\TestBenchCore\ServiceProviderTrait;
use Pusher\Pusher;
use Vinkla\Pusher\PusherFactory;
use Vinkla\Pusher\PusherManager;

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
        $this->assertIsInjectable(PusherFactory::class);
    }

    public function testPusherManagerIsInjectable()
    {
        $this->assertIsInjectable(PusherManager::class);
    }

    public function testBindings()
    {
        $this->assertIsInjectable(Pusher::class);

        $original = $this->app['pusher.connection'];
        $this->app['pusher']->reconnect();
        $new = $this->app['pusher.connection'];

        $this->assertNotSame($original, $new);
        $this->assertEquals($original, $new);
    }
}
