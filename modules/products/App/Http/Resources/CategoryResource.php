<?php

namespace Products\App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "name" => $this->name,
            "slug" => $this->slug,
            "description" => $this->description,
            "parent_id" => !is_null($this->parent_id) ? new self($this->parent) : "",
            "is_active" => $this->is_active ? 'فعال' : 'غیر فعال',
            "icon" => $this->icon,
        ];
    }
}







