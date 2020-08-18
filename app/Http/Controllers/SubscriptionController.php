<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepositoryInterface;

use App\Plan;
use App\Subscription;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    protected function update(Request $request)
    {
        $user = auth()->user();

        $plan = Plan::find($request->plan_id);

        $payment_id = $request->payment_id;
        $validity = $plan->validity;
        $expires_at = now()->addMonths($validity);

        Subscription::updateOrCreate([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
        ], [
            'payment_id' => $payment_id,
            'expires_at' => $expires_at
        ]);

        return response(['user' => $this->userRepository->getUserById($user->id)], 200);
    }
}
