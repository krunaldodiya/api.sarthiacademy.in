<?php

namespace App\Repositories;

use App\Repositories\UserRepositoryInterface;

use App\User;

class UserRepository implements UserRepositoryInterface
{
    public function getUserById($user_id)
    {
        return User::with('subscriptions.plan.course')->where(['id' => $user_id])->first();
    }

    public function authenticate($user, $request)
    {
        $user = $this->getUserById($user->id);

        if ($user->unique_id == null) {
            $user->update(['unique_id' => $request->unique_id]);
        }

        return response([
            'user' => $user,
            'token' => $user->createToken($user->id)->plainTextToken
        ], 200);
    }

    public function checkAuthentication($request)
    {
        $user = User::firstOrCreate([
            'mobile' => $request->mobile,
            'country_id' => $request->country_id,
        ]);

        return $this->authenticate($user, $request);
    }
}
