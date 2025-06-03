<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FeatureUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:10240',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ];
    }
}
