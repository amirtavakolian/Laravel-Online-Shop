<?php

namespace App\Services\ApiResponse;

use Illuminate\Support\Facades\Facade;

/**
 * @method ApiResponseBuilder setStatus(int $status)
 * @method ApiResponseBuilder setData(array $data)
 * @method ApiResponseBuilder setMessage(string $message)
 * @method ApiResponseBuilder withAppends(array $appends)
 * @method ApiResponseBuilder build()
 */
class ApiResponseFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'ApiResponseFacade';
    }
}
