<?php

namespace App\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;

class UserTypeRequest extends FormRequest
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
                'type_name' => 'required|regex:/[A-Za-z. -]/|min:3|max:40|unique:user_types,type_name,' . $post_id
            ];
        } else {
            $rules = [
                'type_name' => 'required|regex:/[A-Za-z. -]/|min:3|max:40|unique:user_types,type_name'
            ];
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'type_name.required' => 'The  user type  field is required.',
            'type_name.unique' => 'This user type is already taken. Please try another !',
            'type_name.regex' => 'The user type must be characters',
            'type_name.min' => 'The user type  must be at least 3 characters',
            'type_name.max' => 'The user type  must be less than  40 characters',


        ];
    }
}
