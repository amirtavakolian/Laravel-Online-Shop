<?php

namespace Authentication\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Authentication\App\Http\Request\RegisterEmailRequest;
use Authentication\App\Services\EmailRegisterService;

class EmailRegistrationController extends Controller
{

    public function __construct(private EmailRegisterService $emailRegisterService)
    {
    }

    public function register(RegisterEmailRequest $request)
    {
        return $this->emailRegisterService->register($request->validated('email'), $request->validated('password'));
    }

}
