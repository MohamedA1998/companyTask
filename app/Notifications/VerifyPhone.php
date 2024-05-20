<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Twilio\TwilioChannel;
use NotificationChannels\Twilio\TwilioSmsMessage;
use Twilio\Rest\Client;

class VerifyPhone extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return [TwilioChannel::class];
    }


    public function toTwilio($notifiable)
    {
        return (new TwilioSmsMessage())
            ->content("Your verification code {$notifiable->phone_verfiy_code}");
    }
}
