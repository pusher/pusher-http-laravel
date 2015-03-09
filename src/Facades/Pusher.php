<?php

namespace Vinkla\Pusher\Facades;

use Illuminate\Support\Facades\Facade;

class Pusher extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'pusher';
    }
}
