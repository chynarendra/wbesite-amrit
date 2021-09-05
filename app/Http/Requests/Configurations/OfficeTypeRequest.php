<?php

namespace App\Http\Requests\Configurations;

use Illuminate\Foundation\Http\FormRequest;

class OfficeTypeRequest extends FormRequest
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
                'name' => 'required|min:3|max:200|unique:office_type,name,' . $post_id
            ];
        } else {
            $rules = [
                'name' => 'required|min:3|max:200|unique:office_type,name'
            ];
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => 'The  office type  field is required.',
            'name.unique' => 'This office type is already taken. Please try another !',
            'name.min' => 'The office type  must be at least 3 characters',
            'name.max' => 'The office type  must be less than  200 characters',


        ];
    }
}
