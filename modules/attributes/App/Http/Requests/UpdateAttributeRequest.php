<?php

namespace Attributes\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAttributeRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => 'required|min:2|unique:attributes,name,'.$this->route('attribute')->id,
        ];
    }
}
