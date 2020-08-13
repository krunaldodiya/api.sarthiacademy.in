<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePassword;
use App\Http\Requests\UpdateProfile;
use App\Http\Requests\SetToken;

use App\Repositories\UserRepositoryInterface;

use App\Wallet;
use App\DeviceToken;

use Error;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function me(Request $request)
    {
        $user = $this->userRepositoryInterface->getUserById(auth()->id());

        return compact('user');
    }

    public function getUserById(Request $request)
    {
        $user = $this->userRepositoryInterface->getUserById($request->user_id);

        return compact('user');
    }

    public function getWallet(Request $request)
    {
        $wallet = Wallet::with([
            'transactions' => function ($query) {
                return $query->where('status', 'success')->orderBy('created_at', 'desc');
            }
        ])
            ->where(['user_id' => auth()->id()])
            ->first();

        return compact('wallet');
    }

    public function updateProfile(UpdateProfile $request)
    {
        $user = auth()->user();

        try {
            $update = $user->update($request->all());

            $user = $this->userRepositoryInterface->getUserById($user->id);

            return compact('user');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function setToken(SetToken $request)
    {
        $user = auth()->user();

        $data = ['user_id' => $user->id, 'token' => $request->device_token];

        $exists = DeviceToken::where($data)->first();

        if (!$exists) {
            return DeviceToken::create($data);
        }

        throw new Error("Token already exists", 401);
    }

    public function uploadAvatar(Request $request)
    {
        $user = auth()->user();

        $file = $request->file('avatar');

        $filename = $file->store($user->id, 'public');

        User::where('id', $user->id)->update(['avatar' => $filename]);

        return response(['filename' => $filename], 200);
    }
}
