<?php

namespace Attributes\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttributeRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => 'required|unique:attributes,name|min:2',
        ];
    }
}
