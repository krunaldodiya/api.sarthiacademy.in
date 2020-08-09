<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasUuid;

    protected $guarded = [];

    protected $dates = [
        'created_at', 'updated_at', 'expires_at'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
