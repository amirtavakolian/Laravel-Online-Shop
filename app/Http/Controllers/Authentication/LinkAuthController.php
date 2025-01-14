<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LinkAuthRequest;
use App\Models\User;
use App\Services\ApiResponse\ApiResponseFacade;
use App\Services\Authentication\LinkAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\FlareClient\Api;

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
