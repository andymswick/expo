<?php

namespace NotificationChannels\Expo\Exceptions;

class CouldNotSendNotification extends \Exception
{
    public static function serviceRespondedWithAnError($exception)
    {
        return new static($exception->message);
    }

    public static function messageDoesNotHaveRecipient()
    {
        return new static('The notifiable does not have a push_token and a recipient has not been set.');
    }
}
