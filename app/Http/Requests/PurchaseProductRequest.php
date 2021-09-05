<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
            $rules = [
                'product_id' => 'required',
                'office_id' => 'required',
                'purchase_date' => 'required|date',
            ];
        return $rules;
    }
    public function messages()
    {
        return [
            'product_id.required' => 'The  product name  field is required.',
            'office_id.unique' => 'The  office name  field is required',


        ];
    }
}
