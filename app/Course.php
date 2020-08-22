<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Jamesh\Uuid\HasUuid;

class Course extends Model
{
    use HasUuid;

    protected $guarded = [];

    protected $dates = [
        'created_at', 'updated_at',
    ];

    public function plans()
    {
        return $this->hasMany(Plan::class);
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function videos()
    {
        return $this->belongsToMany(Video::class, 'course_videos')->orderBy('order');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'course_subject')->orderBy('order');
    }
}
