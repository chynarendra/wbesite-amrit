<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DispatchGeneralValidation extends FormRequest
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
            //
            'DISPATCH_NO'=>'required',
            'DISPATCH_METHOD'=>'required',
            'DISPATCH_DT_NEP'=>'required',
            'DISPATCH_DT_ENG'=>'required',
            'REF_NO'=>'required',
            'ISSUED_TO'=>'required',
            'ADDRESS'=>'required',
            'SUBJECT'=>'required',
        ];
    }
}
