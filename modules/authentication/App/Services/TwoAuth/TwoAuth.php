<?php

namespace Authentication\App\Services\TwoAuth;

use Authentication\App\Enum\Authentication;
use Illuminate\Support\Facades\Redis;

abstract class TwoAuth
{
    public abstract function send();

    protected function storeCode()
    {
        $randomCode = rand(1000, 9999);

        Redis::setex(Authentication::getTwoAuthKey(auth()->user()->id), 120, $randomCode);

        return $randomCode;
    }
}


