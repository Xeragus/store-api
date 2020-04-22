<?php

namespace App\Listeners;

use App\Events\UserWasRegistered;
use App\Mail\UserRegistrationNotificationMail;
use Illuminate\Support\Facades\Mail;

class SendRegistrationEmailToUser
{
    public function handle(UserWasRegistered $event)
    {
        Mail::to($event->getUser()->getEmail())->send(new UserRegistrationNotificationMail($event->getUser()));
    }
}
