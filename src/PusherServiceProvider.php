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
use Pusher;

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

        if (class_exists('Illuminate\Foundation\Application', false)) {
            $this->publishes([$source => config_path('pusher.php')]);
        }

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
        $this->registerBindings($this->app);
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
            return new PusherFactory();
        });

        $app->alias('pusher.factory', PusherFactory::class);
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

        $app->alias('pusher', PusherManager::class);
    }

    /**
     * Register the bindings.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerBindings(Application $app)
    {
        $app->bind('pusher.connection', function ($app) {
            $manager = $app['pusher'];

            return $manager->connection();
        });

        $app->alias('pusher.connection', Pusher::class);
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
            'pusher.connection',
        ];
    }
}
