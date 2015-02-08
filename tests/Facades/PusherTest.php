<?php

namespace Vinkla\Tests\Pusher\Facades;

use GrahamCampbell\TestBench\Traits\FacadeTestCaseTrait;
use Vinkla\Tests\Pusher\AbstractTestCase;

class PusherTest extends AbstractTestCase
{
	use FacadeTestCaseTrait;

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
		return 'Vinkla\Pusher\Facades\Pusher';
	}

	/**
	 * Get the facade route.
	 *
	 * @return string
	 */
	protected function getFacadeRoot()
	{
		return 'Vinkla\Pusher\PusherManager';
	}
}
