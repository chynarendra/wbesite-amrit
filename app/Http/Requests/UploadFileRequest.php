<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadFileRequest extends FormRequest
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
        return [
            'column_name' => 'required',
            'file_title' => 'required',
            'update_file' => 'required|mimes:jpg,jpeg,png|max:1048',
        ];
    }
    public function messages()
    {
        return [
            'column_name.required' => 'The  column field is required.',
            'file_title.required' => 'The  column field is required.',
            'update_file.required' => 'The  file field is  field',
            'update_file.mimes' => 'The  image type must be  jpeg, jpg, png only!',
            'update_file.max' => 'The  image size less than 1 MB !'

        ];
    }
}
