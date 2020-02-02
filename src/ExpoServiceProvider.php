<?php

namespace NotificationChannels\Expo;

use Illuminate\Support\ServiceProvider;

class ExpoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/expo.php' => config_path('expo.php'),
        ], 'config');

        if (! class_exists('AddPushTokenToUsersTable')) {
            $this->publishes([
                __DIR__.'/../database/migrations/add_push_token_to_users_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_add_push_token_to_users_table.php'),
            ], 'migrations');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/expo.php', 'expo');
    }
}
