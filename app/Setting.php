<?php

namespace App;

use Jamesh\Uuid\HasUuid;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasUuid;

    protected $guarded = [];

    public $timestamps = false;
}
