<?php

/*
 * This file is part of Laravel Pusher.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Tests\Pusher\Factories;

use Vinkla\Pusher\Factories\PusherFactory;
use Vinkla\Tests\Pusher\AbstractTestCase;

/**
 * This is the Pusher factory test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class PusherFactoryTest extends AbstractTestCase
{
    public function testMakeStandard()
    {
        $factory = $this->getPusherFactory();

        $return = $factory->make([
            'auth_key' => 'your-auth-key',
            'secret' => 'your-secret',
            'app_id' => 'your-app-id',
            'options' => [],
            'host' => null,
            'port' => null,
            'timeout' => null
        ]);

        $this->assertInstanceOf('Pusher', $return);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutClientId()
    {
        $factory = $this->getPusherFactory();

        $factory->make([]);
    }

    protected function getPusherFactory()
    {
        return new PusherFactory();
    }
}
