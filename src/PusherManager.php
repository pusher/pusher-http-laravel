<?php

namespace Vinkla\Pusher;

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;
use Vinkla\Pusher\Factories\PusherFactory;

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
	function __construct(Repository $config, PusherFactory $factory)
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
