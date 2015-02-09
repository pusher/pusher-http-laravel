<?php

namespace Vinkla\Pusher\Factories;

use Pusher;

class PusherFactory
{
	/**
	 * Make a new Pusher client.
	 *
	 * @param array $config
	 * @return Pusher
	 */
	public function make(array $config)
	{
		$config = $this->getConfig($config);

		return new Pusher(
			$config['auth_key'],
			$config['secret'],
			$config['app_id'],
			$config['options'],
			$config['host'],
			$config['port'],
			$config['timeout']
		);
	}

	/**
	 * Get the configuration data.
	 *
	 * @param string[] $config
	 *
	 * @throws \InvalidArgumentException
	 *
	 * @return string
	 */
	protected function getConfig(array $config)
	{
		$keys = [
			'auth_key',
			'secret',
			'app_id',
			'options',
			'host',
			'port',
			'timeout'
		];

		foreach ($keys as $key) {
			if (!array_key_exists($key, $config)) {
				throw new \InvalidArgumentException(
					'The Pusher client requires authentication.'
				);
			}
		}

		return array_only($config, $keys);
	}

}
