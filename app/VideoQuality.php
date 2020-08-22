<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Jamesh\Uuid\HasUuid;

class VideoQuality extends Model
{
    use HasUuid;

    protected $guarded = [];

    protected $dates = [
        'created_at', 'updated_at',
    ];

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
