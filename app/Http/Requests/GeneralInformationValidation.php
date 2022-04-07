<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneralInformationValidation extends FormRequest
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
            'REF_NO'=>'required',
            'REF_DT_NEP'=>'required',
            'REF_DT_ENG'=>'required',
            'REG_NO'=>'required',
            'REG_DT_NEP'=>'required',
            'REG_DT_ENG'=>'required',
            'ISSUED_BY'=>'required',
            'ADDRESS'=>'required',
            'SUBJECT'=>'required',
        ];
    }
}
