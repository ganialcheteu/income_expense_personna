<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class supplierRequest extends FormRequest
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
            'name'=> 'bail|required|string|min:2',
            'email' => 'bail|required|email',
            'phone'=> 'bail|required|numeric|min:8|regex:/^\+?\d{8,}$/',
            'country'=> 'bail|required|string|min:2',
            'city'=> 'bail|required|string|min:2',
            'address'=> 'bail|required|string|min:2',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string'=> 'Entered Invalid Name',
            'name.min'=> 'Name Must Be Least 2 Characters',
            'email'=> 'Entered Invalid Email',
            'phone.numeric'=>'Phone Must Be Number',
            'phone.min' => 'Phone Must Be Least 8 Numbers',
            'phone.regex' => 'Invalid Phone Number ',
            'address.string'=> 'Address Must Be String',
            'address.min'=> 'Address Must Be Least 2 Characters',
            'city.string'=>'City Must Be String',
            'city.min'=> 'City Must Be Least 2 Characters',
            'country.string'=>'Country Must Be String',
            'country.min'=> 'Country Must Be Least 2 Characters',
        ];
    }
}
