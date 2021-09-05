<?php

namespace App\Http\Requests\Configurations;

use Illuminate\Foundation\Http\FormRequest;

class FiscalYearRequest extends FormRequest
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
                'code' => "required|min:3|max:200|unique:fiscal_years,code,{$post_id},id,deleted_at,NULL",
                'start_date' =>'required|date_format:Y-m-d',
                'end_date' =>'required|date_format:Y-m-d||after:start_date',
            ];
        } else {
            $rules = [
                'code' => "required|min:3|max:200|unique:fiscal_years,code,NULL,id,deleted_at,NULL",
                'start_date' =>'required|date_format:Y-m-d',
                'end_date' =>'required|date_format:Y-m-d||after:start_date',

            ];
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'code.required' => 'The  code  field is required.',
            'code.unique' => 'This code is already taken. Please try another!',
            'code.min' => 'The   code must be  at least 3 characters length',
            'code.max' => 'The   code  must be less than 200 characters',
            'start_date.required' => 'The   start date field is required.',
            'end_date.required' => 'The   end date field is required.',

        ];
    }
}
