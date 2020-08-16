<?php

namespace App;

use Jamesh\Uuid\HasUuid;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Subscription extends Model
{
    use HasUuid;

    protected $guarded = [];

    protected $dates = [
        'created_at', 'updated_at', 'expires_at'
    ];

    protected $appends = ['status'];

    public function getStatusAttribute()
    {
        return $this->expires_at > Carbon::now() ? "Active" : "Expired";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
