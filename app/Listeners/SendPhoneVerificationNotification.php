<?php

namespace App\Listeners;

use App\Contracts\MustVerifyPhone;

class SendPhoneVerificationNotification
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if ($event->user instanceof MustVerifyPhone && !$event->user->hasVerifiedPhone()) {
            $event->user->sendPhoneVerificationNotification();
        }
    }
}
