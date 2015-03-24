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

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;
use Vinkla\Pusher\Factories\PusherFactory;

/**
 * This is the Pusher manager class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class PusherManager extends AbstractManager
{
    /**
     * @var PusherFactory
     */
    private $factory;

    /**
     * @param Repository $config
     * @param PusherFactory $factory
     */
    public function __construct(Repository $config, PusherFactory $factory)
    {
        parent::__construct($config);

        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return mixed
     */
    protected function createConnection(array $config)
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName()
    {
        return 'pusher';
    }

    /**
     * Get the factory instance.
     *
     * @return PusherFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}
