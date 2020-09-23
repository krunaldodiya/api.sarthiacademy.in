<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Jamesh\Uuid\HasUuid;

class Chat extends Model
{
    use HasUuid;

    protected $guarded = [];

    protected $dates = [
        'created_at', 'updated_at',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
