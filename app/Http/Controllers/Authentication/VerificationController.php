<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Services\Authentication\VerificationService;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function __construct(private VerificationService  $verificationService)
    {
    }

    public function generateLink()
    {

    }

    public function verify(int $id, Request $request)
    {
        return $this->verificationService->verify($request, $id);
    }
}
