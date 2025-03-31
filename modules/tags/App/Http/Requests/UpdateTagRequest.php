<?php

namespace Tags\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTagRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:tags,name,' . $this->route('tag')->name,
            'is_active' => 'boolean',
        ];
    }
}
