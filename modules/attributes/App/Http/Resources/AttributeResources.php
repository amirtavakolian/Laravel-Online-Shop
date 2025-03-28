<?php

namespace Attributes\App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeResources extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name
        ];
    }
}
