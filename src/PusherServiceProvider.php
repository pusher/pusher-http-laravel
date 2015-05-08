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

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

/**
 * This is the Pusher service provider class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class PusherServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/pusher.php');

        $this->publishes([$source => config_path('pusher.php')]);

        $this->mergeConfigFrom($source, 'pusher');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFactory($this->app);
        $this->registerManager($this->app);
    }

    /**
     * Register the factory class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerFactory(Application $app)
    {
        $app->singleton('pusher.factory', function () {
            return new Factories\PusherFactory();
        });

        $app->alias('pusher.factory', 'Vinkla\Pusher\Factories\PusherFactory');
    }

    /**
     * Register the manager class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerManager(Application $app)
    {
        $app->singleton('pusher', function ($app) {
            $config = $app['config'];
            $factory = $app['pusher.factory'];

            return new PusherManager($config, $factory);
        });

        $app->alias('pusher', 'Vinkla\Pusher\PusherManager');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'pusher',
            'pusher.factory',
        ];
    }
}
