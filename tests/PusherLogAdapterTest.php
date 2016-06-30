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

use Illuminate\Contracts\Logging\Log;
use Mockery;
use Vinkla\Pusher\PusherLogAdapter;

/**
 * This is the Pusher Log Adapter test class.
 *
 * @author Michal Carson <michal.carson@carsonsoftwareengineering.com>
 */
class PusherLogAdapterTest extends AbstractTestCase
{
    public function testLog()
    {
        $logger = Mockery::mock(Log::class);
        $logger->shouldReceive('log')->with('info', 'this message', [])->andReturnNull();

        $adapter = new PusherLogAdapter($logger);

        $adapter->log('this message');

        $this->addToAssertionCount(1);
    }
}
