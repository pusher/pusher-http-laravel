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

namespace Pusher\Tests\Laravel\Facades;

use GrahamCampbell\TestBenchCore\FacadeTrait;
use Pusher\Laravel\Facades\Pusher;
use Pusher\Laravel\PusherManager;
use Pusher\Tests\Laravel\AbstractTestCase;

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
     * Get the facade root.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return PusherManager::class;
    }
}
