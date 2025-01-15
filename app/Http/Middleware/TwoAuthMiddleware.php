<?php

namespace App\Http\Middleware;

use App\Enum\Authentication;
use App\Services\ApiResponse\ApiResponseFacade;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\Response;

class TwoAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $curretUser = auth()->user();
        $isSetTwoAtuh = Redis::get($curretUser->id . '.' . Authentication::TWO_AUTH->value);

        if (!$isSetTwoAtuh) {
            return ApiResponseFacade::setData([
                'is_twoauth_set' => false,
                'has_mobile' => boolval($curretUser->mobile) ?? false,
                'has_email' => boolval($curretUser->email) ?? false
            ])->build()->response();
        }
        return $next($request);
    }
}
