<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Services\ApiResponse\ApiResponseFacade;
use App\Services\Authentication\OTP\OTPService;
use Illuminate\Http\Request;

class OTPController extends Controller
{

    public function __construct(private OTPService $OTPService)
    {
    }

    public function login(Request $request)
    {
        $request->validate(['mobile' => ['required', 'regex:/((0?9)|(\+?989))\d{2}\W?\d{3}\W?\d{4}/']]);

        $loginResult = $this->OTPService->login($request->input('mobile'));

        $message = match ($loginResult) {
            OTPService::OTP_IS_CURRENLTY_GENERATED => __('messages.auth.' . OTPService::OTP_IS_CURRENLTY_GENERATED),
            OTPService::OTP_CODE_IS_SENT => __('messages.auth.' . OTPService::OTP_CODE_IS_SENT),
        };

        return ApiResponseFacade::setMessage(__($message))->setData([])->build()->response();
    }

    public function verify(Request $request)
    {
        $request->validate([
            'mobile' => ['required', 'regex:/((0?9)|(\+?989))\d{2}\W?\d{3}\W?\d{4}/'],
            'otp' => 'required|numeric|max_digits:4'
        ]);

        $verifyResult = $this->OTPService->verify($request->input('mobile'), $request->input('otp'));

        return ApiResponseFacade::setData(['token' => $verifyResult['token']])
            ->setMessage($verifyResult['message'])
            ->build()
            ->response();
    }
}
