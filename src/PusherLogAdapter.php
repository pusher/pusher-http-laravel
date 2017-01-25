<?php

/*
 * This file is part of Laravel Pusher.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Pusher;

use Illuminate\Contracts\Logging\Log;

/**
 * This is a simple adapter so that log messages from the Pusher class can be redirected to Laravel's logger.
 *
 * @author Michal Carson <michal.carson@carsonsoftwareengineering.com>
 */
class PusherLogAdapter
{
    /** @var Log */
    protected $log;

    /**
     * PusherLogAdapter constructor.
     *
     * @param Log $log
     */
    public function __construct(Log $log)
    {
        $this->log = $log;
    }

    /**
     * Relay a message to the Laravel logger.
     *
     * @param string $message
     *
     * @return void
     */
    public function log($message)
    {
        $this->log->log('info', $message, []);
    }
}
