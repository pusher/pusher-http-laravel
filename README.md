# Laravel Pusher

![pusher](https://user-images.githubusercontent.com/499192/28176443-b96829f8-67f7-11e7-8cad-7322d296266e.jpg)

> A [Pusher](https://github.com/pusher/pusher-http-php) bridge for Laravel. Formerly `vinkla/pusher`.

```php
// Triggering events.
$pusher->trigger('my-channel', 'my_event', 'hello world');

// Authenticating Private channels.
$pusher->socket_auth('my-channel', 'socket_id');

// Want to use the facade?
Pusher::get('/channels');
```

[![Build Status](https://img.shields.io/travis/pusher/pusher-http-laravel/master.svg?style=flat)](https://travis-ci.org/pusher/pusher-http-laravel)
[![StyleCI](https://styleci.io/repos/30508702/shield?style=flat)](https://styleci.io/repos/30508702)
[![Coverage Status](https://img.shields.io/codecov/c/github/pusher/pusher-http-laravel.svg?style=flat)](https://codecov.io/github/pusher/pusher-http-laravel)
[![Latest Version](https://img.shields.io/github/release/pusher/pusher-http-laravel.svg?style=flat)](https://github.com/pusher/pusher-http-laravel/releases)
[![License](https://img.shields.io/packagist/l/pusher/pusher-http-laravel.svg?style=flat)](https://packagist.org/packages/pusher/pusher-http-laravel)

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```bash
$ composer require pusher/pusher-http-laravel
```

Add the service provider to `config/app.php` in the `providers` array. If you're using Laravel 5.5 or greater, there's no need to do this.

```php
Pusher\Laravel\PusherServiceProvider::class
```

If you want you can use the [facade](http://laravel.com/docs/facades). Add the reference in `config/app.php` to your aliases array.

```php
'Pusher' => Pusher\Laravel\Facades\Pusher::class
```

## Configuration

Laravel Pusher requires connection configuration. To get started, you'll need to publish all vendor assets:

```bash
$ php artisan vendor:publish --provider="Pusher\Laravel\PusherServiceProvider"
```

This will create a `config/pusher.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

#### Default Connection Name

This option `default` is where you may specify which of the connections below you wish to use as your default connection for all work. Of course, you may use many connections at once using the manager class. The default value for this setting is `main`.

#### Pusher Connections

This option `connections` is where each of the connections are setup for your application. Example configuration has been included, but you may add as many connections as you would like.

#### Encrypted Channels
To enable [end to end encrypted channels](https://pusher.com/docs/client_api_guide/client_encrypted_channels), you need to uncomment a line from the Pusher config file

```
'app_id' => env('PUSHER_APP_ID'),
'options' => [
    'cluster' => env('PUSHER_APP_CLUSTER'),
    'encryption_master_key' => env('PUSHER_ENCRYPTION_MASTER_KEY'),
],
'host' => null,
'port' => null,
```

Then you need to set an `encryption_master_key` in your `.env` file. You should then be able to publish encrypted events to channels prefixed with `private-encrypted` and you can validate this is working by checking the (dashboard)[https://dashboard.pusher.com] debug console for your app!


## Usage

#### PusherManager

This is the class of most interest. It is bound to the ioc container as `pusher` and can be accessed using the `Facades\Pusher` facade. This class implements the ManagerInterface by extending AbstractManager. The interface and abstract class are both part of [Graham Campbell's](https://github.com/GrahamCampbell) [Laravel Manager](https://github.com/GrahamCampbell/Laravel-Manager) package, so you may want to go and checkout the docs for how to use the manager class over at that repository. Note that the connection class returned will always be an instance of `Pusher`.

#### Facades\Pusher

This facade will dynamically pass static method calls to the `pusher` object in the ioc container which by default is the `PusherManager` class.

#### PusherServiceProvider

This class contains no public methods of interest. This class should be added to the providers array in `config/app.php`. This class will setup ioc bindings.

### Examples

Here you can see an example of just how simple this package is to use. Out of the box, the default adapter is `main`. After you enter your authentication details in the config file, it will just work:

```php
// You can alias this in config/app.php.
use Pusher\Laravel\Facades\Pusher;

Pusher::trigger('my-channel', 'my-event', ['message' => $message]);
// We're done here - how easy was that, it just works!

Pusher::getSettings();
// This example is simple and there are far more methods available.
```

The Pusher manager will behave like it is a `Pusher`. If you want to call specific connections, you can do that with the connection method:

```php
use Pusher\Laravel\Facades\Pusher;

// Writing this…
Pusher::connection('main')->log('They see me logging…');

// …is identical to writing this
Pusher::log('They hatin…');

// and is also identical to writing this.
Pusher::connection()->log('Tryin to catch me testing dirty…');

// This is because the main connection is configured to be the default.
Pusher::getDefaultConnection(); // This will return main.

// We can change the default connection.
Pusher::setDefaultConnection('alternative'); // The default is now alternative.
```

If you prefer to use dependency injection over facades like me, then you can inject the manager:

```php
use Pusher\Laravel\PusherManager;

class Foo
{
    protected $pusher;

    public function __construct(PusherManager $pusher)
    {
        $this->pusher = $pusher;
    }

    public function bar()
    {
        $this->pusher->trigger('my-channel', 'my-event', ['message' => $message]);
    }
}

App::make('Foo')->bar();
```

## Documentation

There are other classes in this package that are not documented here. This is because the package is a Laravel wrapper of [the official Pusher package](https://github.com/pusher/pusher-php-server).

## License

[MIT](LICENSE) © [Pusher](https://pusher.com)
