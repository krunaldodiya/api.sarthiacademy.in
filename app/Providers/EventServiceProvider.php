<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Listeners\GenerateUserInfo;

use App\Events\NotificationWasCreated;
use App\Listeners\SendPushNotification;

use App\DeviceToken;
use App\Observers\DeviceTokenObserver;

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
            GenerateUserInfo::class,
        ],

        NotificationWasCreated::class => [
            SendPushNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        DeviceToken::observe(DeviceTokenObserver::class);
    }
}
