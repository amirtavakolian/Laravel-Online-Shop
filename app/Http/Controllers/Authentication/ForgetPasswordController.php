<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgetPasswordRequest;
use App\Http\Requests\Auth\ForgetPasswordVerifyRequest;
use App\Services\Authentication\ForgetPasswordService;

class ForgetPasswordController extends Controller
{

    public function __construct(private ForgetPasswordService $forgetPasswordService)
    {
    }

    public function reset(ForgetPasswordRequest $request)
    {
       return $this->forgetPasswordService->reset($request->input('email'));
    }

    public function verify(ForgetPasswordVerifyRequest $request)
    {
        return $this->forgetPasswordService->verify($request->input('email'), $request->input('code'), $request->input('password'));
    }
}
