<?php

namespace App\Http\Requests\Configurations;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
                'city_name' => 'required|min:3|max:200|unique:city,city_name,' . $post_id,
                'district_id' => 'required'
            ];
        } else {
            $rules = [
                'city_name' => 'required|min:3|max:200|unique:city,city_name',
                'district_id' => 'required'
            ];
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'city_name.required' => 'The  name  field is required.',
            'city_name.unique' => 'This name is already taken. Please try another !',
            'city_name.min' => 'The name  must be at least 3 characters',
            'city_name.max' => 'The name  must be less than  200 characters',


        ];
    }
}
