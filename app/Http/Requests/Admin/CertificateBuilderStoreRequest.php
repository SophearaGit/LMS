<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CertificateBuilderStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'background' => ['nullable', 'max:3000', 'image'],
            'title' => ['nullable', 'max:255', 'string'],
            'subtitle' => ['nullable', 'max:255', 'string'],
            'description' => ['nullable', 'string'],
            'signature' => ['nullable', 'max:3000', 'image'],
        ];
    }
}
