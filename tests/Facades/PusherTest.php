<?php

/*
 * This file is part of Laravel Pusher.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Tests\Pusher\Facades;

use GrahamCampbell\TestBenchCore\FacadeTrait;
use Vinkla\Pusher\Facades\Pusher;
use Vinkla\Pusher\PusherManager;
use Vinkla\Tests\Pusher\AbstractTestCase;

/**
 * This is the Pusher test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class PusherTest extends AbstractTestCase
{
    use FacadeTrait;

    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'pusher';
    }

    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return Pusher::class;
    }

    /**
     * Get the facade route.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return PusherManager::class;
    }
}
