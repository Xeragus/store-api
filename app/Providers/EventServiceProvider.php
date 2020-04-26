<?php

namespace App\Providers;

use App\Events\LocationWasAdded;
use App\Events\LocationWasDeleted;
use App\Events\ProductWasCreated;
use app\Events\CategoryWasCreated;
use App\Listeners\SendAddedLocationNotificationEmail;
use App\Listeners\SendCreatedCategoryNotificationEmail;
use App\Listeners\SendDeletedLocationNotificationEmail;
use App\Listeners\SendProductCreationNotificationEmailToCompany;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        ProductWasCreated::class => [
            SendProductCreationNotificationEmailToCompany::class,
            SendProductCreationNotificationEmailToCompany::class,
            SendProductCreationNotificationEmailToCompany::class,
            SendProductCreationNotificationEmailToCompany::class,
        ],

        LocationWasAdded::class => [
            SendAddedLocationNotificationEmail::class
        ],

        LocationWasDeleted::class => [
            SendDeletedLocationNotificationEmail::class
        ],

        CategoryWasCreated::class => [
            SendCreatedCategoryNotificationEmail::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
