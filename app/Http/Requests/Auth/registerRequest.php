<?php
namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class registerRequest extends FormRequest
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
            'name'     => ['bail', 'required', 'string', 'min:2','regex:/^[a-z A-Z]+$/'],
            'email'    => ['bail','required', 'string', 'email','max:255', Rule::unique(User::class)],
            'role'     => ['bail','required', 'string', 'in:super_admin,admin'],
            'password' => ['bail','required', 'string','min:8'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'Name  required',
            'name.string'       => 'Name must be characters.',
            'name.min'          => 'Name must be at least 2 characters.',
            'name.regex'        => 'Name must be valid Name | Not special characters.',
            'email.required'    => 'Email  required.',
            'email.email'       => 'Email must be valid.',
            'role.required'     => 'Role  required',
            'role.in'           => 'Role selected is invalid',
            'password.required' => 'Password  required',
            'password.string'   => 'Password must be characters.',
            'password.min'      => 'Password must be at least 8 characters.',
        ];
    }
}
