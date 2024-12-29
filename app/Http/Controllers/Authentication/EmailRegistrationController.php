<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterEmailRequest;
use App\Services\Authentication\EmailRegisterService;

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
