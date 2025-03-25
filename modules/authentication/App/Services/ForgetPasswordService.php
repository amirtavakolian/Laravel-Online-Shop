<?php

namespace Authentication\App\Services;

use App\Services\ApiResponse\ApiResponseFacade;
use Authentication\App\Enum\Authentication;
use Authentication\App\Jobs\Auth\ForgetPasswordJob;
use Authentication\App\Models\User;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class ForgetPasswordService
{

    public function reset(string $email)
    {
        $userEmail = User::query()->where('email', $email)->first();

        if ($userEmail) {
            $data = $this->generateCode($email);

            ForgetPasswordJob::dispatch($data, $email);
        }

        return ApiResponseFacade::setMessage(__('messages.auth.forget_password_code_has_sent'))->build()->response();
    }

    private function generateCode(string $email)
    {
        $data = [
            "code" => strtolower(Str::random(6)),
            Authentication::FORGET_PASS_WRONG_CODE_COUNTER->value => 0,
            "email" => $email
        ];

        Redis::hmset(Authentication::getForgetPassKey($email), $data);

        Redis::expire(Authentication::getForgetPassKey($email), 120 * 60);

        return $data;
    }

    public function verify($email, $code, $password)
    {
        $data = Redis::hgetall(Authentication::getForgetPassKey($email));

        if (empty($data)) {
            return ApiResponseFacade::setMessage(__('messages.auth.email_not_exist'))->build()->response();
        }

        if ($data[Authentication::FORGET_PASS_WRONG_CODE_COUNTER->value] == 5) {
            Redis::del(Authentication::getForgetPassKey($email));

            return ApiResponseFacade::setMessage(__('messages.auth.the_requested_code_was_removed_due_to_repeated_errors_please_request_a_new_code'))
                ->build()->response();
        }

        if($data['email'] != $email){
            return ApiResponseFacade::setMessage(__('messages.auth.your_email_or_code_is_wrong'))->build()->response();
        }

        if ($data['code'] != $code) {
            Redis::hset(Authentication::getForgetPassKey($email),
                Authentication::FORGET_PASS_WRONG_CODE_COUNTER->value, ++$data[Authentication::FORGET_PASS_WRONG_CODE_COUNTER->value]);

            return ApiResponseFacade::setMessage(__('messages.auth.your_email_or_code_is_wrong'))->build()->response();
        }

        User::query()->where('email', $email)->first()->update([
            'password' => $password
        ]);

        Redis::del(Authentication::getForgetPassKey($email));

        return ApiResponseFacade::setMessage(__('messages.auth.your_password_changed_successfully'))->build()->response();
    }
}
