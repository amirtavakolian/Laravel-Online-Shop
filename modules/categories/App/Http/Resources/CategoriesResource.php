<?php

namespace Categories\App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriesResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'parent_id' => $this->parent ? new CategoriesResource($this->parent) : 'ندارد',
            'description' => $this->description,
            'is_active' => $this->is_active,
            'icon' => $this->icon,
        ];
    }
}
