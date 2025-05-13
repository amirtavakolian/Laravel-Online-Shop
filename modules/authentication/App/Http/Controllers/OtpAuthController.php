<?php

namespace Authentication\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ApiResponse\ApiResponseFacade;
use Authentication\App\Http\Request\OTPLoginRequest;
use Authentication\App\Models\User;
use Authentication\App\Services\OtpAuthService;
use Illuminate\Http\Request;

class OtpAuthController extends Controller
{

    public function __construct(private OtpAuthService $OTPService)
    {
    }

    public function login(OTPLoginRequest $request)
    {
        $loginResult = $this->OTPService->sendOtp($request->input('mobile'));

        $message = match ($loginResult) {
            OtpAuthService::OTP_IS_CURRENLTY_GENERATED => __('messages.auth.' . OtpAuthService::OTP_IS_CURRENLTY_GENERATED),
            OtpAuthService::OTP_CODE_IS_SENT => __('messages.auth.' . OtpAuthService::OTP_CODE_IS_SENT),
        };

        return ApiResponseFacade::setMessage(__($message))->build()->response();
    }

    public function verify(OTPLoginRequest $request)
    {
        $verifyResultMessage = $this->OTPService->verify($request->input('mobile'), $request->input('otp'));

        if (is_null($verifyResultMessage)) {
            $token = User::query()->firstOrCreate(['mobile' => $request->input('mobile')], [])->createToken('API')->plainTextToken;
            $this->OTPService->removeOtpCode($request->input('mobile'));
        }

        return ApiResponseFacade::setData(['token' => $token ?? ''])
            ->setMessage($verifyResultMessage ?? '')
            ->build()
            ->response();
    }
}
