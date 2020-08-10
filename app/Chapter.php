<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Jamesh\Uuid\HasUuid;

class Chapter extends Model
{
    use HasUuid;

    protected $guarded = [];

    protected $dates = [
        'created_at', 'updated_at',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
