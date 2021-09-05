<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignRequest extends FormRequest
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
                'campaign_name' => 'required|min:3|max:200|unique:campaign,campaign_name,' . $post_id,
                'city_id' => 'required',
                'start_date' =>'required|date_format:Y-m-d',
                'end_date' =>'required|date_format:Y-m-d||after:start_date',
            ];
        } else {
            $rules = [
                'campaign_name' => 'required|min:3|max:200|unique:campaign,campaign_name',
                'city_id' => 'required',
                'start_date' =>'required|date_format:Y-m-d',
                'end_date' =>'required|date_format:Y-m-d||after:start_date',
            ];
        }
        return $rules;
    }
}
