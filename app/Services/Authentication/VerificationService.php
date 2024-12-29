<?php

namespace App\Services\Authentication;

use App\Models\User;
use App\Services\ApiResponse\ApiResponseFacade;

class VerificationService
{
    public function verify($request, $id)
    {
        abort_unless($request->hasValidSignature(), 419);

        User::query()->where('id', $id)->first()->update([
            'email_verified_at' => now()
        ]);

        return ApiResponseFacade::setMessage(__('messages.auth.email_has_been_verified'))->build()->response();
    }
}
