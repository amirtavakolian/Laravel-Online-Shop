<?php

namespace Authentication\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ApiResponse\ApiResponseFacade;
use Authentication\App\Http\Request\TwoAuthMethodRequest;
use Authentication\App\Services\TwoAuth\TwoAuthService;
use Illuminate\Http\Request;

class TwoAuthController extends Controller
{

    public function __construct(private TwoAuthService $twoAuthService)
    {
    }

    public function generate(TwoAuthMethodRequest $request)
    {
        $twoAuthCodeTtl = $this->twoAuthService->generate($request->input('twoauth_method'));

        return ApiResponseFacade::setMessage(__('messages.auth.two_auth_code_has_been_sent'))
            ->setData(['exp' => $twoAuthCodeTtl])
            ->build()->response();
    }

    public function verify(Request $request)
    {
        return $this->twoAuthService->verify($request->input('code'));
    }
}
