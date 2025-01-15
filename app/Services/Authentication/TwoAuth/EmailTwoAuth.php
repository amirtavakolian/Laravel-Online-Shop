<?php

namespace App\Services\Authentication\TwoAuth;

use App\Enum\Authentication;
use App\Mail\Auth\TwoAuthMail;
use Illuminate\Support\Facades\Mail;

class EmailTwoAuth extends TwoAuth
{

    public function send()
    {
        Mail::to(auth()->user()->email)->send(new TwoAuthMail($this->storeCode()));
    }
}
