<?php

namespace Categories\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|integer|exists:categories,id',
            'slug' => 'required|unique:categories,slug,' . $this->route('category')->id,
            'is_filter' => 'required|exists:attributes,id',
            'is_filter.*' => 'exists:attributes,id',
            'is_variation' => 'required|exists:attributes,id',
            'is_active' => 'required|boolean',
            'icon' => 'nullable|string|max:255',
        ];
    }
}
