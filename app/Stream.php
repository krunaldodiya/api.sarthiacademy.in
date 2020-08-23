<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    use HasUuid;

    protected $guarded = [];

    protected $dates = [
        'created_at', 'updated_at',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
