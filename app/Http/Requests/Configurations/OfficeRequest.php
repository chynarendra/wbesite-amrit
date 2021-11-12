<?php

namespace App\Http\Requests\Configurations;

use Illuminate\Foundation\Http\FormRequest;

class OfficeRequest extends FormRequest
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
                'office_name' => 'required|min:3|max:200|unique:office,office_name,' . $post_id,
                'office_type_id' => 'required',
            ];
        } else {
            $rules = [
                'office_name' => 'required|min:3|max:200|unique:office,office_name',
                'office_type_id' => 'required',
            ];
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'office_name.required' => 'The  name  field is required.',
            'office_name.unique' => 'This name is already taken. Please try another !',
            'office_name.min' => 'The name  must be at least 3 characters',
            'office_name.max' => 'The name  must be less than  200 characters',


        ];
    }
}
