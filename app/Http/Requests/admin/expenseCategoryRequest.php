<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class expenseCategoryRequest extends FormRequest
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
            'category' => 'bail|string|min:2',
        ];
    }

    public function messages(): array
    {
        return [
            'category.string' => 'The category must be a string.',
            'category.min' => 'The category must be at least 2 characters.'
        ];
    }
}
