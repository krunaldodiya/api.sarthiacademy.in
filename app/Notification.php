<?php

namespace App;

use App\Events\NotificationWasCreated;

use App\Traits\HasUuid;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasUuid;

    protected $guarded = [];

    protected $dates = [
        'created_at', 'updated_at', 'expires_at'
    ];

    protected $dispatchesEvents = [
        'created' => NotificationWasCreated::class
    ];
}
