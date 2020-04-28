<?php

namespace App\Listeners;

use App\Events\CategoryWasReallyCreated;
use App\Mail\CategoryCreatedNotificationMail;
use Illuminate\Support\Facades\Mail;

class SendReallyCreatedCategoryNotificationEmail
{
    public function handle(CategoryWasReallyCreated $event)
    {
        $category = $event->getCategory();

        Mail::to('boobs@test.com')->send(new CategoryCreatedNotificationMail($category));
    }
}
