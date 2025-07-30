<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class customerRequest extends FormRequest
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
            'name' => 'required|string|min:2',
            'email' => 'required|email',
            'phone' => 'required|numeric|regex:/^\+?\d{8,}$/',
            'country' => 'required|string|min:2',
            'city' => 'required|string|min:2',
            'address' => 'required|string|min:2',
            'customer_type_id' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'name.min' => 'Name must be least than 2 characters',
            'email.required' => 'Email is required',
            'email'=> 'Must Be Valid Email',
            'phone.required' => 'Phone is required',
            'phone.numeric' => 'Phone must be a number',
            'phone.regex'=> 'Phone Must Be Valid Phone Number',
            'country.required' => 'Country is required',
            'country.min' => 'Country must be least than 2 characters',
            'city.required' => 'City is required',
            'city.min' => 'City must be least than 2 characters',
            'address.required' => 'Address is required',
            'address.min' => 'Address must be least than 2 characters',

        ];
    }
}
