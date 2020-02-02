# Expo notification channel for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/laravel-notification-channels/expo.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/expo)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/laravel-notification-channels/expo/master.svg?style=flat-square)](https://travis-ci.org/laravel-notification-channels/expo)
[![StyleCI](https://styleci.io/repos/237816489/shield)](https://styleci.io/repos/237725707)
[![Quality Score](https://img.shields.io/scrutinizer/g/laravel-notification-channels/expo.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-notification-channels/expo)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/laravel-notification-channels/expo/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-notification-channels/expo/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel-notification-channels/expo.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/expo)

This package makes it easy to send push notifications to your [Expo](https://docs.expo.io/versions/latest/guides/push-notifications/) app with Laravel 5.5+ and 6.0.

For more information on how to set up push notifications from within your Expo app, please refer to their [documentation on push notifications](https://docs.expo.io/versions/latest/guides/push-notifications/).

## Contents

- [Installation](#installation)
- [Usage](#usage)
	- [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)

## Installation

You can install this package via composer using this command:

```bash
composer require "laravel-notification-channels/expo"
```

The package will automatically register itself.

You can publish the optional migration with:

```bash
php artisan vendor:publish --provider="NotificationChannels\Expo\ExpoServiceProvider" --tag="migrations"
```

After the migration has been published you can add the `push_token` the users table by running the migrations:

```bash
php artisan migrate
```

You can publish the optional config-file with:

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

If a notification supports being sent as a Expo push notification, you should define a `toExpo` method on the notification class. This method will receive a `$notifiable` entity and should return a `NotificationChannels\Expo\ExpoMessage` instance. Expo messages may contain a title and body as well as "jsonData" that adds additional data that is sent to the Expo app. Let's take a look at a basic `toExpo` example:

```php
// ...
use NotificationChannels\Expo\ExpoChannel;
use NotificationChannels\Expo\ExpoMessage;

class CheckInTime extends Notification
{

	// ...

    public function via($notifiable)
    {
        return [ExpoChannel::class];
    }

    public function toExpo($notifiable)
    {
        return (new ExpoMessage)
            ->title("It's time to check in!")
            ->body('Check in now for us to print your name badge')
            ->setJsonData(['screen' => 'CheckIn']);
    }
}
```

A `to` method is required if the notifiable does not have a `token` value set in `config/expo.php`. You can optionally publish this config as well as a migration that will add a `push_token` to the `users` table after `remember_token`. 

Below is an example of using the `to` method, if you would rather not use the config or migration.

```php
// ...
use NotificationChannels\Expo\ExpoChannel;
use NotificationChannels\Expo\ExpoMessage;

class CheckInTime extends Notification
{

	// ...

    public function via($notifiable)
    {
        return [ExpoChannel::class];
    }

    public function toExpo($notifiable)
    {
		return (new ExpoMessage)
			->to('ExponentPushToken[**********************]')
            ->title("It's time to check in!")
            ->body('Check in now for us to print your name badge')
            ->setJsonData(['screen' => 'CheckIn']);
    }
}
```

### Available Message methods

* `to(string)`: Set the recipient of the message. This will default to the notifiable's `push_token` attribute.
* `title(string)`: Set the title of the message.
* `body(string)`: Set the body of the message.
* `enableSound()`: Enable the default sound to be played.
* `disableSound()`: Disable the default sound to be played.
* `badge(int)`: Set the badge to the int value. (iOS only)
* `setTtl(int)`: Set the time to live value. (iOS only)
* `setChanelId(int)`: Set the chanelId of the notification. (Android only)
* `setJsonData(array|string)`: Set the extra data of the notification, can be passed an array or a json string.
* `toArray()`: Converts the message to an array.

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
