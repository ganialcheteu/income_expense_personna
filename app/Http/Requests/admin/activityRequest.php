<?php
namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class activityRequest extends FormRequest
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
            'name'        => 'bail|required|string|min:2|max:35',
            'description' => 'bail|required|string|min:25|max:255',
            'image.*'     => 'bail|nullable|file|image|mimes:jpeg,png,jpg,gif|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'        => 'Name is required.',
            'name.min'             => 'Name must be at least 2 characters.',
            'name.max'             => 'Name must not exceed 35 characters.',
            'description.required' => 'Description is required.',
            'description.min'      => 'Description must be at least 25 characters.',
            'description.max'      => 'Description must not exceed 255 characters.',
            'image.*.file'         => 'The uploaded file must be valid.',
            'image.*.image'        => 'The file must be an image.',
            'image.*.mimes'        => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.*.max'          => 'The image size must not exceed 5 MB.',

        ];
    }
}
