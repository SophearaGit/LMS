<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AboutUsSectionUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:10240',
            'rounded_text'      => 'nullable|string|max:255',
            'lerner_count'      => 'nullable|integer|min:0',
            'lerner_count_text' => 'nullable|string|max:255',
            'lerner_image'      => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:10240',
            'title'             => 'required|string|max:255',
            'description'       => 'nullable|string|max:1000',
            'button_text'       => 'nullable|string|max:255',
            'button_url'        => 'nullable|url|max:2048',
            'video_url'         => 'nullable|url|max:2048',
            'video_image'       => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:10240',
        ];
    }
}
