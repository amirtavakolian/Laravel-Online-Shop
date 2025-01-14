<?php

namespace App\Services\Authentication;

use App\Jobs\Auth\SendLoginWithLinkUrlJob;
use App\Models\User;
use App\Services\ApiResponse\ApiResponseFacade;
use Illuminate\Support\Facades\URL;

class LinkAuthService
{

    public function generate(string $email)
    {
        $user = User::query()->where('email', $email)->first();

        if (!$user) {
            return ApiResponseFacade::setMessage(__('messages.auth.for_using_login_with_link_feature_please_register_with_your_email_first'))
                ->build()->response();
        }

        $url = URL::temporarySignedRoute('auth.link.verify', 120, ['email' => $email]);

        SendLoginWithLinkUrlJob::dispatch($email, $url);

        return ApiResponseFacade::setMessage(__('messages.auth.login_url_is_sent_please_check_your_email'))->build()->response();
    }
}
