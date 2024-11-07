<?php

namespace App\Services\ApiResponse;


class ApiResponseBuilder
{

    public $apiResponser;

    public function __construct()
    {
        $this->apiResponser = new ApiResponse();
    }

    public function setStatus(int $status)
    {
        $this->apiResponser->status = $status;
        return $this;
    }

    public function setData(array $data)
    {
        $this->apiResponser->data = $data;
        return $this;
    }

    public function setMessage(string $message)
    {
        $this->apiResponser->message = $message;
        return $this;
    }

    public function withAppends(array $appends)
    {
        $this->apiResponser->setAppends($appends);
        return $this;
    }

    public function build()
    {
        return $this->apiResponser;
    }
}
