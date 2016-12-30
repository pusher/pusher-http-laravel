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

use Pusher;
use Vinkla\Pusher\PusherFactory;

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
            'timeout' => null,
        ]);

        $this->assertInstanceOf(Pusher::class, $return);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutAuthKey()
    {
        $factory = $this->getPusherFactory();

        $factory->make([
            'secret' => 'your-secret',
            'app_id' => 'your-app-id',
            'options' => [],
            'host' => null,
            'port' => null,
            'timeout' => null,
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutAppId()
    {
        $factory = $this->getPusherFactory();

        $factory->make([
            'auth_key' => 'your-auth-key',
            'secret' => 'your-secret',
            'options' => [],
            'host' => null,
            'port' => null,
            'timeout' => null,
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutSecret()
    {
        $factory = $this->getPusherFactory();

        $factory->make([
            'auth_key' => 'your-auth-key',
            'app_id' => 'your-app-id',
            'options' => [],
            'host' => null,
            'port' => null,
            'timeout' => null,
        ]);
    }

    protected function getPusherFactory()
    {
        return new PusherFactory();
    }
}
