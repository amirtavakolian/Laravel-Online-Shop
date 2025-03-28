<?php

namespace Brands\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => 'required|unique:brands,name|min:3',
            'slug' => 'required|unique:brands,slug|min:3'
        ];
    }
}
