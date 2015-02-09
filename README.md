Laravel Pusher
==============

Laravel [Pusher](https://pusher.com/) is a [Pusher](https://pusher.com/) bridge for Laravel 5 using the [official Pusher package](https://github.com/pusher/pusher-php-server).

[![Build Status](https://img.shields.io/travis/vinkla/pusher/master.svg?style=flat)](https://travis-ci.org/vinkla/pusher)
[![Latest Stable Version](http://img.shields.io/packagist/v/vinkla/pusher.svg?style=flat)](https://packagist.org/packages/vinkla/pusher)
[![License](https://img.shields.io/packagist/l/vinkla/pusher.svg?style=flat)](https://packagist.org/packages/vinkla/pusher)

## Installation
Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```bash
composer require vinkla/pusher:~1.0
```

Add the service provider to ```config/app.php``` in the `providers` array.

```php
'Vinkla\Pusher\PusherServiceProvider'
```

If you want you can use the [facade](http://laravel.com/docs/facades). Add the reference in ```config/app.php``` to your aliases array.

```php
'Pusher' => 'Vinkla\Pusher\Facades\Pusher'
```

#### Looking for a Laravel 4 compatable version?

Please use [@artdarek's Laravel 4 Pusherer package](https://github.com/artdarek/pusherer) instead.

## Configuration
More documentation coming soon…

## Documentation
There are other classes in this package that are not documented here. This is because the package is a Laravel wrapper of [the official Pusher package](https://github.com/pusher/pusher-php-server).

## License

The Laravel Pusher package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
