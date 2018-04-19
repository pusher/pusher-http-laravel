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

namespace Pusher\Laravel;

use InvalidArgumentException;
use Pusher\Pusher;

/**
 * This is the Pusher factory class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class PusherFactory
{
    /**
     * Make a new Pusher client.
     *
     * @param array $config
     *
     * @return \Pusher\Pusher
     */
    public function make(array $config): Pusher
    {
        $config = $this->getConfig($config);

        return $this->getClient($config);
    }

    /**
     * Get the configuration data.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    protected function getConfig(array $config): array
    {
        $keys = [
            'auth_key',
            'secret',
            'app_id',
            'options',
            'host',
            'port',
            'timeout',
        ];

        foreach ($keys as $key) {
            if (!array_key_exists($key, $config)) {
                throw new InvalidArgumentException("Missing configuration key [$key].");
            }
        }
        
        foreach ($config['options'] as $option => $value) {
            if (is_null($value)) {
                unset($config['options'][$option]);
            }
        }

        return array_only($config, $keys);
    }

    /**
     * Get the pusher client.
     *
     * @param string[] $auth
     *
     * @return \Pusher\Pusher
     */
    protected function getClient(array $auth): Pusher
    {
        return new Pusher(
            $auth['auth_key'],
            $auth['secret'],
            $auth['app_id'],
            $auth['options'],
            $auth['host'],
            $auth['port'],
            $auth['timeout']
        );
    }
}
