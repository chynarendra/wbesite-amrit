<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
                'paid_date' => 'required|date',
                'paid_amount' => 'required',
                'customer_id' => 'required',
                'product_id' => 'required',
                'payment_method_id' => 'required',
            ];
        return $rules;
    }
}
