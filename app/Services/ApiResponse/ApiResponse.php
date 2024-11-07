<?php

namespace App\Services\ApiResponse;

class ApiResponse
{

    public string $message = '';
    public mixed $data = null;
    public int $status = 200;
    public array $appends = [];

    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    public function setData(mixed $data)
    {
        $this->data = $data;
    }

    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    public function setAppends(array $appends)
    {
        $this->appends = $appends;
    }

    public function response()
    {
        $body = [];
        !is_null($this->message) && $body['message'] = $this->message;
        !is_null($this->data) && $body['data'] = $this->data;
        $body = $body + $this->appends;
        return response()->json($body, $this->status);
    }
}
