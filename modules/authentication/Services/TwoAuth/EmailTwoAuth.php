<?php

namespace Authentication\Services\TwoAuth;

use Authentication\Mail\Auth\TwoAuthMail;
use Illuminate\Support\Facades\Mail;

class EmailTwoAuth extends TwoAuth
{

    public function send()
    {
        Mail::to(auth()->user()->email)->send(new TwoAuthMail($this->storeCode()));
    }
}
