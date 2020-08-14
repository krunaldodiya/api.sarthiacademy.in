<?php

namespace App;

use Jamesh\Uuid\HasUuid;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasUuid;

    protected $guarded = [];

    protected $dates = [
        'created_at', 'updated_at',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_videos');
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
