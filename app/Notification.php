<?php

namespace App;

use App\Events\NotificationWasCreated;

use Jamesh\Uuid\HasUuid;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasUuid;

    protected $guarded = [];

    protected $dates = [
        'created_at', 'updated_at',
    ];

    protected $dispatchesEvents = [
        'created' => NotificationWasCreated::class
    ];
}
