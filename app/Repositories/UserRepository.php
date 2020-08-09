<?php

namespace App\Repositories;

use App\Repositories\UserRepositoryInterface;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Str;

class UserRepository implements UserRepositoryInterface
{
    public function getUserById($user_id)
    {
        return User::with('institute.plans', 'subscriptions.plan')->where(['id' => $user_id])->first();
    }

    public function register($request)
    {
        $user = User::create([
            'mobile' => $request->mobile,
            'password' => bcrypt(Str::random(8))
        ]);

        return $this->login($user, $request);
    }

    public function login($user, $request)
    {
        $user = $this->getUserById($user->id);

        if ($user->unique_id == null) {
            $user->update([
                'unique_id' => $request->unique_id,
                'imei' => json_encode($request->imei),
            ]);
        }

        $token = JWTAuth::fromUser($user);

        return response(['token' => $token, 'user' => $user], 200);
    }
}
