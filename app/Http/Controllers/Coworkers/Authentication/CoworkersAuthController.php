<?php

namespace App\Http\Controllers\Coworkers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Coworkers\RegisterCoworkersRequest;
use App\Models\Coworker;
use App\Services\ApiResponse\ApiResponseFacade;
use App\Services\Authentication\OtpAuthService;
use Illuminate\Http\Request;

class CoworkersAuthController extends Controller
{

    public function __construct(private OtpAuthService $otpAuthService)
    {
    }

    public function register(RegisterCoworkersRequest $request)
    {
        Coworker::query()->create($request->validated());

        return ApiResponseFacade::setMessage(__('messages.auth.coworker_successfully_registered'))->build()->response();
    }

    public function login(Request $request)
    {
        $request->validate(['mobile' => ['required', 'exists:coworkers,mobile', 'regex:/((0?9)|(\+?989))\d{2}\W?\d{3}\W?\d{4}/']]);

        $this->otpAuthService->sendOtp($request->input('mobile'));

        return ApiResponseFacade::setMessage(__('messages.auth.enterance_code_is_sent'))->build()->response();
    }

    public function verify(Request $request)
    {
        $request->validate([
            'mobile' => ['required', 'regex:/((0?9)|(\+?989))\d{2}\W?\d{3}\W?\d{4}/'],
            'otp' => 'required|numeric|max_digits:6'
        ]);

        $verifyOtpResult = $this->otpAuthService->verify($request->input('mobile'), $request->input('otp'));

        if (is_string($verifyOtpResult)) {
            return ApiResponseFacade::setMessage($verifyOtpResult)->build()->response();
        }

        $coworker = Coworker::query()->where('mobile', $request->input('mobile'))->first();

        return ApiResponseFacade::setData(['token' => $coworker->createToken('coworker')->plainTextToken])->build()->response();
    }
}
