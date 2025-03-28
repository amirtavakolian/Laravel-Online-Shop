<?php

namespace Brands\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|unique:brands,name,' . $this->route('brand')->id,
            'slug' => 'required|min:3|unique:brands,slug,' . $this->route('brand')->id
        ];
    }
}

