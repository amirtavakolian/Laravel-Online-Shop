<?php

namespace Categories\App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryAttributesResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'is_filter' => $this->pivot->is_filter,
            'is_variation' => $this->pivot->is_variation
        ];
    }
}
