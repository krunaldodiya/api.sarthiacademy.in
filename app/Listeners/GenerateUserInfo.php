<?php

namespace App\Listeners;

use App\User;

use Illuminate\Support\Str;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateUserInfo
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
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $username = Str::random(8);

        User::where('id', $event->user->id)->update([
            'username' => $username,
            'email' => "$username@sarthiacademy.in"
        ]);
    }
}
