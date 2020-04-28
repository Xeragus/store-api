<?php

namespace App\Listeners;

use App\Events\CategoryWasCreated;
use App\Mail\CategoryCreatedNotificationMail;
use Illuminate\Support\Facades\Mail;

class SendCreatedCategoryNotificationEmail
{
    public function handle(CategoryWasCreated $categoryWasCreated)
    {
        $category = $categoryWasCreated->getCategory();

        Mail::to('boobs@test.com')->send(new CategoryCreatedNotificationMail($category));
    }
}
