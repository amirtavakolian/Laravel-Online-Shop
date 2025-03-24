<?php

namespace Authentication\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ApiResponse\ApiResponseFacade;
use Authentication\Http\Request\LinkAuthRequest;
use Authentication\Models\User;
use Authentication\Services\LinkAuthService;
use Illuminate\Http\Request;

class LinkAuthController extends Controller
{

    public function __construct(private LinkAuthService $linkAuthService)
    {
    }

    public function generate(LinkAuthRequest $request)
    {
        return $this->linkAuthService->generate($request->input('email'));
    }

    public function verify(Request $request)
    {
        abort_unless($request->hasValidSignature(), 419);

        $user = User::query()->where('email', $request->query('email'))->first();

        return ApiResponseFacade::setData([
            'token' => $user->createToken('API')->plainTextToken
        ])->build()->response();
    }
}
