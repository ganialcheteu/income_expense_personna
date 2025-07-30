<?php
namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'  => ['required', 'string', 'min:2', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.min'     => 'Name Must Be Least Than 2 Characters.',
            'name.max'     => 'Name Must Not Exceed 255 Characters.',
            'email.max'    => 'Email Must Not Exceed 255 Characters.',
            'email.string' => 'Email Must Be String.',
            'email.email'  => 'Email Must Be Valid Email.',
        ];
    }
}
