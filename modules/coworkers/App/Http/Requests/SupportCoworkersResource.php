<?php

namespace Coworkers\App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupportCoworkersResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
        ];
    }
}
