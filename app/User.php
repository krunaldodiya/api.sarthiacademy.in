<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Jamesh\Uuid\HasUuid;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, HasUuid;

    protected $guarded = [];

    protected $dates = [
        'created_at', 'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['setting', 'avatar'];

    public function getAvatarAttribute()
    {
        if ($this->avatar !== null) {
            return $this->avatar;
        }

        return "default.png";
    }

    public function getSettingAttribute()
    {
        $settings = Setting::all();

        return $settings->reduce(function ($carry, $item) {
            return array_merge($carry, [$item->key => $item->value]);
        }, []);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function device_tokens()
    {
        return $this->hasMany(DeviceToken::class);
    }
}
