<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasUuid;

    protected $guarded = [];

    protected $dates = [
        'created_at', 'updated_at', 'expires_at'
    ];

    public function chapters()
    {
        return $this->hasMany(Chapter::class)->orderBy('order');
    }
}
