<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Events\NotificationWasCreated;

use App\User;

use App\Repositories\PushNotificationRepository;

use Illuminate\Support\Facades\Storage;

class SendPushNotification
{
    public $pushNotificationRepository;

    public function __construct(PushNotificationRepository $pushNotificationRepository)
    {
        $this->pushNotificationRepository = $pushNotificationRepository;
    }

    /**
     * Handle the event.
     *
     * @param  NotificationWasCreated  $event
     * @return void
     *
     *
     */
    public function handle(NotificationWasCreated $event)
    {
        $notification = $event->notification;

        $this->pushNotificationRepository->notify("/topics/users", [
            'notification' => $notification,
            'title' => $notification['title'],
            'body' => $notification['description'],
            'image' => asset("storage/{$notification['image']}"),
        ]);
    }
}
