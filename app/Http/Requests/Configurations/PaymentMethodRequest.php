<?php

namespace App\Http\Requests\Configurations;

use Illuminate\Foundation\Http\FormRequest;

class PaymentMethodRequest extends FormRequest
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
        if ($this->method() == 'PUT') {
            $post_id = $this->segment(3);
            $rules = [
                'method_name' => 'required|min:3|max:200|unique:payment_method,method_name,' . $post_id
            ];
        } else {
            $rules = [
                'method_name' => 'required|min:3|max:200|unique:payment_method,method_name'
            ];
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'method_name.required' => 'The  payment method  field is required.',
            'method_name.unique' => 'This payment method is already taken. Please try another !',
            'method_name.min' => 'The payment method  must be at least 3 characters',
            'method_name.max' => 'The payment method  must be less than  200 characters',


        ];
    }
}
