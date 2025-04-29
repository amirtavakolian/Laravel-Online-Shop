<?php

namespace Modules\Banners\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBannerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required|string',
            'button_content' => 'required|string',
            'priority' => 'required|integer|min:0|max:255',
            'type' => 'required|string|max:255|in:slider,banner',
            'button_link' => 'required|string|max:255',
            'is_active' => 'boolean|in:0,1',
            'button_icon' => 'nullable|string|max:255',
        ];
    }
}
