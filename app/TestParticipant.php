<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Jamesh\Uuid\HasUuid;

class TestParticipant extends Model
{
    use HasUuid;

    protected $guarded = [];

    protected $dates = [
        'created_at', 'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function test_answers()
    {
        return $this->hasMany(TestAnswer::class, 'test_id', 'test_id')->where('user_id', $this->user_id);
    }
}
