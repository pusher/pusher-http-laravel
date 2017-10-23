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

use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use Illuminate\Contracts\Config\Repository;
use Mockery;
use Pusher\Laravel\PusherFactory;
use Pusher\Laravel\PusherManager;
use Pusher\Pusher;

/**
 * This is the Pusher manager test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class PusherManagerTest extends AbstractTestBenchTestCase
{
    public function testCreateConnection()
    {
        $config = ['path' => __DIR__];

        $manager = $this->getManager($config);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('pusher.default')->andReturn('pusher');

        $this->assertSame([], $manager->getConnections());

        $return = $manager->connection();

        $this->assertInstanceOf(Pusher::class, $return);

        $this->assertArrayHasKey('pusher', $manager->getConnections());
    }

    protected function getManager(array $config)
    {
        $repository = Mockery::mock(Repository::class);
        $factory = Mockery::mock(PusherFactory::class);

        $manager = new PusherManager($repository, $factory);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('pusher.connections')->andReturn(['pusher' => $config]);

        $config['name'] = 'pusher';

        $manager->getFactory()->shouldReceive('make')->once()
            ->with($config)->andReturn(Mockery::mock(Pusher::class));

        return $manager;
    }
}
