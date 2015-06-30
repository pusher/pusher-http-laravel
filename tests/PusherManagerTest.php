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

use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use Mockery;
use Vinkla\Pusher\PusherManager;

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

        $this->assertInstanceOf('Pusher', $return);

        $this->assertArrayHasKey('pusher', $manager->getConnections());
    }

    protected function getManager(array $config)
    {
        $repository = Mockery::mock('Illuminate\Contracts\Config\Repository');
        $factory = Mockery::mock('Vinkla\Pusher\PusherFactory');

        $manager = new PusherManager($repository, $factory);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('pusher.connections')->andReturn(['pusher' => $config]);

        $config['name'] = 'pusher';

        $manager->getFactory()->shouldReceive('make')->once()
            ->with($config)->andReturn(Mockery::mock('Pusher'));

        return $manager;
    }
}
