<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VideoSectionUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3000',
            'video_url' => 'nullable|url',
            'description' => 'nullable|string|max:1000',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|url',
        ];
    }
}
