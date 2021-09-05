<?php

namespace App\Http\Requests\ApiSetting;

use Illuminate\Foundation\Http\FormRequest;

class LocalBosdyRequest extends FormRequest
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
                'name_np' => 'required|min:3|max:200|unique:local_body,name_np,' . $post_id,
                'name_en' => 'required|min:3|max:200|unique:local_body,name_en,' . $post_id,
                'district_id' => 'required',
            ];
        } else {
            $rules = [
                'name_np' => 'required|min:3|max:200|unique:local_body,name_np',
                'name_en' => 'required|min:3|max:200|unique:local_body,name_en',
                'district_id' => 'required',
            ];
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'name_np.required' => 'The  nepali name  field is required.',
            'name_np.unique' => 'This nepali name is already taken. Please try another !',
            'name_np.min' => 'The nepali name  must be at least 3 characters',
            'name_np.max' => 'The nepali name  must be less than  200 characters',
            'name_en.required' => 'The  english name  field is required.',
            'name_en.unique' => 'This english name is already taken. Please try another !',
            'name_en.min' => 'The english name  must be at least 3 characters',
            'name_en.max' => 'The english name  must be less than  200 characters',


        ];
    }
}
