<?php


namespace App\Listeners;

use App\Events\LocationWasDeleted;
use App\Mail\LocationWasDeletedNotificationMail;
use Illuminate\Support\Facades\Mail;

class SendDeletedLocationNotificationEmail
{
    public function handle(LocationWasDeletes $locationWasDeleted)
    {
        $location = $locationWasDeleted->getLocation();

        Mail::to($location->getCompany()->getEmail())->send(new LocationWasDeletedNotificationMail($location));

    }

}
