<?php

namespace App\Services\SMS;

class SmsMessage
{
    private $receptor;
    private $message;

    public function setReceptor(string $receptor)
    {
        $this->receptor = $receptor;
        return $this;
    }

    public function setMessage(string $message)
    {
        $this->message = $message;
        return $this;
    }

    public function getReceptor()
    {
        return $this->receptor;
    }

    public function getMessage()
    {
        return $this->message;
    }
}
