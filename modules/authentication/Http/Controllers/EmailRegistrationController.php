<?php

namespace Authentication\Http\Controllers;

use App\Http\Controllers\Controller;
use Authentication\Http\Request\RegisterEmailRequest;
use Authentication\Services\EmailRegisterService;

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
