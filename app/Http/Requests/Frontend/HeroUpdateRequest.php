<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class HeroUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'label' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'btn_txt' => 'nullable|string|max:255',
            'btn_url' => 'nullable|url|max:255',
            'vid_btn_txt' => 'nullable|string|max:255',
            'vid_btn_url' => 'nullable|url|max:255',
            'banner_item_title' => 'nullable|string|max:255',
            'banner_item_subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:10240',
            'round_txt' => 'nullable|string|max:255',
        ];
    }
}
