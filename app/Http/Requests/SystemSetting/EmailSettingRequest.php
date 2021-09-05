<?php

namespace App\Http\Requests\SystemSetting;

use Illuminate\Foundation\Http\FormRequest;

class EmailSettingRequest extends FormRequest
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
            'mail_driver' => 'required|min:2|max:100',
            'mail_host_name' => 'required|min:2|max:100',
            'mail_port' => 'required|min:2|max:100',
            'mail_user_name' => 'required|min:2|max:100',
            'mail_password' => 'required|min:2|max:100',
            'mail_encryption' => 'required|min:2|max:100',

        ];

        return $rules;
    }
    public function messages()
    {
        return [
            'mail_driver.required' => 'The  mail  driver field is required.',
            'mail_host_name.required' => 'The  mail  host name field is required.',
            'mail_port.required' => 'The  mail  port  field is required.',
            'mail_user_name.required' => 'The  mail  user name  field is required.',
            'mail_password.required' => 'The  mail  password  field is required.',
            'mail_encryption.required' => 'The  mail  port  field is required.',


        ];
    }
}
