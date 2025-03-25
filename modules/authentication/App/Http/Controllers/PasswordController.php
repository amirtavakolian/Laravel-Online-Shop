<?php

namespace Authentication\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ApiResponse\ApiResponseFacade;
use Authentication\App\Http\Request\LoginWithPasswordRequest;
use Authentication\App\Http\Request\SetPasswordForMobileRequest;
use Authentication\App\Services\OtpAuthService;
use Authentication\App\Services\PasswordAuth\PasswordAuthService;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function __construct(private OtpAuthService $OTPService, private PasswordAuthService $passwordAuthService)
    {
    }

    public function setPassword(SetPasswordForMobileRequest $request)
    {
        $verifyResultMessage = $this->OTPService->verify(auth()->user()->mobile, $request->input('otp'));

        if (is_null($verifyResultMessage)) {
            auth()->user()->update([
                'password' => Hash::make($request->input('password'))
            ]);

            $this->OTPService->removeOtpCode($request->input('mobile'));
        }

        return ApiResponseFacade::setMessage(is_null($verifyResultMessage) ? __('messages.auth.password_has_been_set') : $verifyResultMessage)
            ->setStatus(!is_null($verifyResultMessage) ? 419 : 200)
            ->build()
            ->response();
    }

    public function sendVerificationCode()
    {
        $changePasswordVerificationCode = $this->OTPService->sendOtp(auth()->user()->mobile);

        $message = match ($changePasswordVerificationCode) {
            OtpAuthService::OTP_IS_CURRENLTY_GENERATED => __('messages.auth.' . OtpAuthService::OTP_IS_CURRENLTY_GENERATED),
            OtpAuthService::OTP_CODE_IS_SENT => __('messages.auth.' . OtpAuthService::OTP_CODE_IS_SENT),
        };

        return ApiResponseFacade::setMessage(__($message))->setData([])->build()->response();
    }

    public function hasPassword()
    {
        return ApiResponseFacade::setData(['is_password_set' => (bool)auth()->user()->password])->build()->response();
    }

    public function login(LoginWithPasswordRequest $request)
    {
        return $this->passwordAuthService->login($request->input('mobile'), $request->input('password'));
    }


}
