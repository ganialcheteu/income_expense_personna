<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class expenseTypeRequest extends FormRequest
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
            'type' => 'bail|string|min:2'
        ];
    }
    public function messages(): array
    {
        return [
            'type.string' => 'The type must be a string.',
            'type.min' => 'The type must be at least 2 characters.'
        ];
    }
}
