<?php

namespace Authentication\App\Services;

use App\Services\ApiResponse\ApiResponseFacade;
use Illuminate\Support\Facades\Auth;

class VerificationService
{
    public function verify($request, $id)
    {
        abort_unless($request->hasValidSignature(), 419);

        Auth::user()->markEmailAsVerified();

        return ApiResponseFacade::setMessage(__('messages.auth.email_has_been_verified'))->build()->response();
    }
}
