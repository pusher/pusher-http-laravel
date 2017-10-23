<?php

/*
 * This file is part of Laravel Pusher.
 *
 * (c) Pusher, Ltd (https://pusher.com)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pusher\Tests\Laravel;

use GrahamCampbell\TestBenchCore\ServiceProviderTrait;
use Pusher\Laravel\PusherFactory;
use Pusher\Laravel\PusherManager;
use Pusher\Pusher;

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
