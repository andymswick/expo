# Expo notification channel for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/laravel-notification-channels/expo.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/expo)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/laravel-notification-channels/expo/master.svg?style=flat-square)](https://travis-ci.org/laravel-notification-channels/expo)
[![StyleCI](https://styleci.io/repos/237725707/shield)](https://styleci.io/repos/237725707)
[![Quality Score](https://img.shields.io/scrutinizer/g/laravel-notification-channels/expo.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-notification-channels/expo)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/laravel-notification-channels/expo/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-notification-channels/expo/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel-notification-channels/expo.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/expo)

This package makes it easy to send notifications using [Expo](link to service) with Laravel 5.5+ and 6.0

This is where your description should go. Add a little code example so build can understand real quick how the package can be used. Try and limit it to a paragraph or two.


## Contents

- [Installation](#installation)
	- [Setting up the Expo service](#setting-up-the-expo-service)
- [Usage](#usage)
	- [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation

Please also include the steps for any third-party service setup that's required for this package.

### Setting up the Expo service

Optionally include a few steps how users can set up the service.

## Installation

You can install this package via composer using this command:

```bash
composer require "laravel-notification-channels/expo"
```

The package will automatically register itself.

You can publish the migration with:

```bash
php artisan vendor:publish --provider="NotificationChannels\Expo\ExpoServiceProvider" --tag="migrations"
```

After the migration has been published you can add the `push_token` the users table by running the migrations:

```bash
php artisan migrate
```

You can publish the config-file with:

```bash
php artisan vendor:publish --provider="NotificationChannels\Expo\ExpoServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
return [

    /*
     * The attribute on the notifiable that will be accessed by default for the `to` method.
     */
    'token' => env('EXPO_PUSH_TOKEN', 'push_token'),

];
```

## Usage

Some code examples, make it clear how to use the package

### Available Message methods

A list of all available options

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email andymswick@gmail.com instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Andy Swick](https://github.com/andymswick)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
