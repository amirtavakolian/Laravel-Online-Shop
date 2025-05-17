<?php

namespace Modules\SpeechToText\app\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SpeechToTextResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            "id" => $this['id'],
            "status" => $this['status']
        ];
    }
}
