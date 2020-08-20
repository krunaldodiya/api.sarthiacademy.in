<?php

namespace App;

use Jamesh\Uuid\HasUuid;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasUuid;

    protected $guarded = [];

    protected $dates = [
        'created_at', 'updated_at',
    ];

    protected $appends = ['status'];

    public function getStatusAttribute()
    {
        $test = TestParticipant::where(['user_id' => auth()->id(), 'test_id' => $this->id])->first();

        if ($test) {
            return $test->status;
        }

        return "Pending";
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'test_questions');
    }

    public function participants()
    {
        return $this->hasMany(TestParticipant::class);
    }
}
