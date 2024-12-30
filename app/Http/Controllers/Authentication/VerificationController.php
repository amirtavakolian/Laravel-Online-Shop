<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Services\ApiResponse\ApiResponseFacade;
use App\Services\Authentication\VerificationService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    public function __construct(private VerificationService $verificationService)
    {
    }

    public function sendLink(Request $request)
    {
        Auth::user()->sendEmailVerificationNotification();

        return ApiResponseFacade::setMessage(__('messages.auth.verification_link_has_sent'))->build()->response();
    }

    public function verify(int $id, Request $request)
    {
        return $this->verificationService->verify($request, $id);
    }
}
