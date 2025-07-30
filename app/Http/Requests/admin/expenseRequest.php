<?php
namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class expenseRequest extends FormRequest
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
            'name'                => 'bail|required|string|min:2',
            'amount'              => 'bail|required|numeric|min:1',
            'payment_date'        => 'bail|required|date',
            'activity_id'         => 'nullable',
            'expense_category_id' => 'bail|required',
            'expense_type_id'     => 'bail|required',
            'supplier_id'         => 'bail|required',
            'image.*'             => 'bail|nullable|file|image|mimes:jpeg,png,jpg,gif|max:5120',

        ];
    }
    public function messages(): array
    {
        return [
            'name.required'        => 'Name Is required.',
            'name.min'             => 'Name Must Be Least Than 2 Characters',
            'payment_date'         => 'Payment Date Is Required ',
            'amount.min'           => 'Amount Must Be Greater Than Entered Number',
            'amount.numeric'       => 'Amount Must Be Number',
            'expense_category_id'  => 'Expense Category Is Required',
            'expense_type_id'      => 'Expense Type Is Required',
            'image.*.file'         => 'The Uploaded File Must Be Valid.',
            'supplier_id.required' => 'Supplier Is Required',
            'image.*.image'        => 'The File Must Be An Image.',
            'image.*.mimes'        => 'The Image Must Be A File Of Type: jpeg, png, jpg, gif.',
            'image.*.max'          => 'The Image Size Must Not Exceed 5 MB.',

        ];
    }
}
