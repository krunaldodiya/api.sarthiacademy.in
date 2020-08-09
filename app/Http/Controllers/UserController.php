<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfile;
use App\Repositories\UserRepositoryInterface;
use App\User;
use App\DeviceToken;
use Illuminate\Http\Request;
use Error;

class UserController extends Controller
{
    public $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function setToken(Request $request)
    {
        $user = auth()->user();

        $data = ['user_id' => $user->id, 'token' => $request->token];

        $exists = DeviceToken::where($data)->first();

        if (!$exists) {
            return DeviceToken::create($data);
        }

        throw new Error("Token already exists", 401);
    }

    public function updateProfile(UpdateProfile $request)
    {
        $user = auth()->user();

        $data = $request->all();
        $data['status'] = true;

        $update = User::find($user->id)->update($data);

        if ($update) {
            return response(['user' => $this->userRepository->getUserById($user->id)], 200);
        }

        return response(['errors' => "error"], 400);
    }

    public function uploadAvatar(Request $request)
    {
        $user = auth()->user();

        $file = $request->file('avatar');

        $filename = $file->store($user->id, 'public');

        User::where('id', $user->id)->update(['avatar' => $filename]);

        return response(['filename' => $filename], 200);
    }

    public function me(Request $request)
    {
        $user = auth()->user();

        return response(['user' => $this->userRepository->getUserById($user->id)], 200);
    }
}
