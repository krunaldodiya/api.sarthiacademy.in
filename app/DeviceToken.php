<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\HasUuid;

class DeviceToken extends Model
{
    use HasUuid;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
