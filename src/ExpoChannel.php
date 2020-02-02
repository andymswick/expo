<?php

namespace NotificationChannels\Expo;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Notifications\Notification;
use NotificationChannels\Expo\Exceptions\CouldNotSendNotification;

class ExpoChannel
{
    /**
     * The HTTP client instance.
     *
     * @var \GuzzleHttp\Client
     */
    protected $http;

    /**
     * Create a new Slack channel instance.
     *
     * @param  \GuzzleHttp\Client  $http
     * @return void
     */
    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @throws \NotificationChannels\Expo\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toExpo($notifiable);

        if ($message->to === '' || $message->to === null) {
            $tokenAttribute = config('expo.token', 'push_token');
            $message->to = $notifiable->$tokenAttribute;

            if ($message->to === '' || $message->to === null) {
                throw CouldNotSendNotification::messageDoesNotHaveRecipient();
            }
        }

        try {
            return $this->http->post('https://exp.host/--/api/v2/push/send', ['json' => $message->toArray()]);
        } catch (RequestException $e) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($e);
        }
    }
}
