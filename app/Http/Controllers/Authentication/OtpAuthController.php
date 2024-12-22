<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ApiResponse\ApiResponseFacade;
use App\Services\Authentication\OtpAuthService;
use Illuminate\Http\Request;

class OtpAuthController extends Controller
{

    public function __construct(private OtpAuthService $OTPService)
    {
    }

    public function login(Request $request)
    {
        $request->validate(['mobile' => ['required', 'regex:/((0?9)|(\+?989))\d{2}\W?\d{3}\W?\d{4}/']]);

        $loginResult = $this->OTPService->sendOtp($request->input('mobile'));

        $message = match ($loginResult) {
            OtpAuthService::OTP_IS_CURRENLTY_GENERATED => __('messages.auth.' . OtpAuthService::OTP_IS_CURRENLTY_GENERATED),
            OtpAuthService::OTP_CODE_IS_SENT => __('messages.auth.' . OtpAuthService::OTP_CODE_IS_SENT),
        };

        return ApiResponseFacade::setMessage(__($message))->setData([])->build()->response();
    }

    public function verify(Request $request)
    {
        $request->validate([
            'mobile' => ['required', 'regex:/((0?9)|(\+?989))\d{2}\W?\d{3}\W?\d{4}/'],
            'otp' => 'required|numeric|max_digits:4'
        ]);

        $verifyResultMessage = $this->OTPService->verify($request->input('mobile'), $request->input('otp'));

        if(is_null($verifyResultMessage)){
            $token = User::query()->firstOrCreate(['mobile' => $request->input('mobile')], [])->createToken('API')->plainTextToken;
            $this->OTPService->removeOtpCode($request->input('mobile'));
        }

        return ApiResponseFacade::setData(['token' => $token ?? ''])
            ->setMessage($verifyResultMessage ?? '')
            ->build()
            ->response();
    }
}
