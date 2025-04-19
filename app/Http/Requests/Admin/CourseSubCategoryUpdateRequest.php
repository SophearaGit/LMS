<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CourseSubCategoryUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3000',
            'icon' => 'required|string|max:255',
            'name' => 'required|string|max:255|unique:course_categories,name,' . $this->course_sub_category->id,
            'show_aat_trending' => 'nullable|boolean',
            'status' => 'nullable|boolean',
        ];
    }
}
