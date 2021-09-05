<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            $post_id = $this->segment(2);
            $rules = [
                'contact' => 'required|min:10|max:15|unique:customers,contact,' . $post_id,
                'email' => 'nullable|email|unique:customers,email,' . $post_id,
                'customer_source_id' => 'required',
                'customer_name' => 'required|min:3|max:200',
            ];
        } else {
            $rules = [
                //'contact' => 'required|min:10|max:15|unique:customers,contact',
                'email' => 'nullable|email|unique:customers,email',
                'customer_source_id' => 'required',
                'customer_name' => 'required|min:3|max:200',
            ];
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'campaign_id.required' => 'The  campaign  field is required.',
        ];
    }
}
