<?php

namespace Authentication\Http\Controllers;

use App\Http\Controllers\Controller;
use Authentication\Http\Request\ForgetPasswordRequest;
use Authentication\Http\Request\ForgetPasswordVerifyRequest;
use Authentication\Services\ForgetPasswordService;

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
