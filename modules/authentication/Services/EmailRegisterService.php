<?php

namespace Authentication\Services;

use App\Services\ApiResponse\ApiResponseFacade;
use Authentication\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class EmailRegisterService
{

    public function register(string $email, string $password)
    {
        $newUser = User::query()->create([
            "email" => $email,
            'password' => Hash::make($password)
        ]);

        event(new Registered($newUser));

        return ApiResponseFacade::setData([
            'token' => $newUser->createToken('API')->plainTextToken
        ])->setMessage(__('messages.auth.you_have_registred_succesfully'))->build()->response();
    }
}
