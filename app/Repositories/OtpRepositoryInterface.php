<?php

namespace App\Repositories;

interface OtpRepositoryInterface
{
    public function requestOtp($mobile, $otp, $message);
    public function verifyOtp($mobile, $otp);
}
