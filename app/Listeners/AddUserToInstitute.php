<?php

namespace App\Listeners;

use App\Events\UserWasCreated;
use App\Institute;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddUserToInstitute
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserWasCreated  $event
     * @return void
     */
    public function handle(UserWasCreated $event)
    {
        $institute = Institute::first();

        $event->user->update(['institute_id' => $institute->id]);
    }
}
