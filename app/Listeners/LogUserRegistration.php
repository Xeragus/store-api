<?php

namespace App\Listeners;

use App\Events\UserWasRegistered;
use Illuminate\Support\Facades\Log;

class LogUserRegistration
{
    public function handle(UserWasRegistered $event)
    {
        Log::info('User with id #' . $event->getUser() . ' was registered!');
    }
}
