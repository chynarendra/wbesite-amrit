<?php

namespace App\Http\Requests\Configurations;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
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
                'name' => 'required|min:3|max:200|unique:product_category,name,' . $post_id,
                'short_name' => 'nullable|min:1|max:200|unique:product_category,short_name,' . $post_id,
            ];
        } else {
            $rules = [
                'name' => 'required|min:3|max:200|unique:product_category,name',
                'short_name' => 'nullable|min:1|max:200|unique:product_category,short_name',
            ];
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => 'The  name  field is required.',
            'name.unique' => 'This name is already taken. Please try another !',
            'name.min' => 'The name  must be at least 3 characters',
            'name.max' => 'The name  must be less than  200 characters',


        ];
    }
}
