<?php

namespace App\Http\Requests\SystemSetting;

use Illuminate\Foundation\Http\FormRequest;

class LoginSettingRequest extends FormRequest
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
            'login_title' => 'required|min:3|max:200',
            'login_background_image' => 'nullable|mimes:jpeg,jpg,png||max:1048',

        ];

        return $rules;
    }
    public function messages()
    {
        return [
            'login_title.required' => 'The  login field is required.',
            'login_background_image.mimes' => 'The image must be a file of type: jpeg, jpg, png.',
            'login_background_image.max' => 'Image size must be 1 MB !',
            'login_title.min' =>'The  name  at least 3 length.',


        ];
    }
}
