<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CusomerQueryRequest extends FormRequest
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
                'ph_no' => 'required|min:10|max:15|unique:customer_query,ph_no,' . $post_id,
                'email' => 'nullable|email|unique:customer_query,email,' . $post_id,
                'question' => 'required',
                'name' => 'required|min:3|max:200',
                'address' => 'required|min:3|max:200',
                'source_of_query_id' => 'required',
            ];
        } else {
            $rules = [
                'ph_no' => 'required|min:10|max:15|unique:customer_query,ph_no',
                'email' => 'nullable|email|unique:customer_query,email',
                'question' => 'required',
                'name' => 'required|min:3|max:200',
                'address' => 'required|min:3|max:200',
                'source_of_query_id' => 'required',
            ];
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'source_of_query_id.required' => 'The  query source  field is required.',

        ];
    }
}
