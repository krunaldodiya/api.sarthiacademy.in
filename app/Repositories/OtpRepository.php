<?php

namespace App\Repositories;

use Error;

use App\Repositories\OtpRepositoryInterface;
use Illuminate\Support\Facades\Http;

class OtpRepository implements OtpRepositoryInterface
{
    private function generateUrl($type, $mobile, $otp, $message)
    {
        $base_url = "https://control.msg91.com/api";

        $authKey = env('MSG91_KEY');

        if ($type == 'request_otp') {
            return "$base_url/sendotp.php?authkey=$authKey&mobile=$mobile&otp=$otp&message=$message";
        }

        if ($type == 'verify_otp') {
            return "$base_url/verifyRequestOTP.php?authkey=$authKey&mobile=$mobile&otp=$otp";
        }
    }

    private function process($url)
    {
        $response = Http::get($url);

        return $response->json();
    }

    public function requestOtp($mobile, $otp, $message)
    {
        $url = $this->generateUrl("request_otp", $mobile, $otp, $message);

        return $this->process($url);
    }

    public function verifyOtp($mobile, $otp)
    {
        $url = $this->generateUrl("verify_otp", $mobile, $otp, null);

        return $this->process($url);
    }
}
