<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LatestCourseSectionUpdateRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_one' => 'nullable|integer|exists:course_categories,id',
            'category_two' => 'nullable|integer|exists:course_categories,id',
            'category_three' => 'nullable|integer|exists:course_categories,id',
            'category_four' => 'nullable|integer|exists:course_categories,id',
            'category_five' => 'nullable|integer|exists:course_categories,id',
        ];
    }
}
