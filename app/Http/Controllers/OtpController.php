<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestOtp;
use App\Http\Requests\VerifyOtp;
use App\Repositories\OtpRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\User;

class OtpController extends Controller
{
    public $otpRepository;
    public $userRepository;

    public function __construct(OtpRepositoryInterface $otpRepository, UserRepositoryInterface $userRepository)
    {
        $this->otpRepository = $otpRepository;
        $this->userRepository = $userRepository;
    }

    public function requestOtp(RequestOtp $request)
    {
        $mobile_cc = "91{$request->mobile}";
        $otp = mt_rand(1000, 9999);
        $message = "$otp is Your otp for phone verification.";

        $response = $this->otpRepository->requestOtp($mobile_cc, $otp, $message);

        if ($response['type'] === 'success') {
            return response(['otp' => $otp], 200);
        }

        return response(['errors' => ['otp' => $response['message']]], 401);
    }

    public function verifyOtp(VerifyOtp $request)
    {
        $mobile_cc = "91{$request->mobile}";
        $otp = $request->otp;

        $response = $this->otpRepository->verifyOtp($mobile_cc, $otp);

        if ($response['type'] === 'success') {
            $user = User::where(['mobile' => $request->mobile])->first();

            if ($user) {
                return $this->userRepository->login($user, $request);
            }

            return $this->userRepository->register($request);
        }

        return response(['errors' => ['otp' => $response['message']]], 401);
    }
}
