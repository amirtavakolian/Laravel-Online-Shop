<?php

namespace Modules\Index\app\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryVariationAttributesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'filter_attributes' => CategoryVariationAttributesValueResource::collection($this->variationAttributesValue->unique('value'))
        ];
    }
}
