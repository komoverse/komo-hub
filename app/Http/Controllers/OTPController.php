<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OTPHP\TOTP;
use Session;

class OTPController extends Controller
{
    public function createOTP() {
        $otp = TOTP::create();
        $secret_key = $otp->getSecret();
        $otp->setLabel('Komoverse - '.Session::get('userdata')->komo_username);
        $qrcode = $otp->getQrCodeUri(
            'https://api.qrserver.com/v1/create-qr-code/?data=[DATA]&size=300x300&ecc=M',
            '[DATA]'
        );
        $data = [
            'secret_key' => $secret_key,
            'qrcode' => $qrcode,
        ];
        return json_encode($data);
    }

    public function validateOTP($secret_key, $otp_input) {
        $otp = TOTP::create($secret_key);
        return $otp->verify($otp_input);
    }

    public function viewOTPChallenge() {
        return view('user.otp-challenge');
    }
}
