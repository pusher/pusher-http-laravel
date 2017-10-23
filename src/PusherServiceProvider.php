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

use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;
use Pusher\Pusher;

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

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('pusher.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('pusher');
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
        $this->registerFactory();
        $this->registerManager();
        $this->registerBindings();
    }

    /**
     * Register the factory class.
     *
     * @return void
     */
    protected function registerFactory()
    {
        $this->app->singleton('pusher.factory', function () {
            return new PusherFactory();
        });

        $this->app->alias('pusher.factory', PusherFactory::class);
    }

    /**
     * Register the manager class.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('pusher', function (Container $app) {
            $config = $app['config'];
            $factory = $app['pusher.factory'];

            return new PusherManager($config, $factory);
        });

        $this->app->alias('pusher', PusherManager::class);
    }

    /**
     * Register the bindings.
     *
     * @return void
     */
    protected function registerBindings()
    {
        $this->app->bind('pusher.connection', function (Container $app) {
            $manager = $app['pusher'];

            return $manager->connection();
        });

        $this->app->alias('pusher.connection', Pusher::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides(): array
    {
        return [
            'pusher',
            'pusher.factory',
            'pusher.connection',
        ];
    }
}
