<?php

namespace App;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasUuid;

    protected $guarded = [];

    protected $dates = [
        'created_at', 'updated_at', 'expires_at'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function institutes()
    {
        return $this->belongsToMany(Institute::class, 'institute_plans');
    }
}
