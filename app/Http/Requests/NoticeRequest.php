<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoticeRequest extends FormRequest
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
            $post_id = $this->segment(2);
            $rules = [
                'notice_title' => 'required|min:3|unique:notices,notice_title,' . $post_id,
                'notice_description' => 'required|min:3|max:200',
            ];
        } else {
            $rules = [
                'notice_title' => 'nullable|min:3|unique:notices,notice_title',
                'notice_description' => 'required|min:3',
            ];
        }
        return $rules;
    }
}
