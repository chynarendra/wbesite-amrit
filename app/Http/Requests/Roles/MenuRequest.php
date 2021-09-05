<?php

namespace App\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
                'menu_controller' => 'required',
                'menu_link' => 'required',
                'menu_icon' => 'required',
                'menu_order' => 'required',
                'menu_name' => 'required|unique:menus,menu_name,' . $post_id
            ];
        } else {
            $rules = [
                'menu_name' => 'required|unique:menus,menu_name',
                'menu_controller' => 'required',
                'menu_link' => 'required',
                'menu_icon' => 'required',
                'menu_order' => 'required'
            ];
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'parent_id.required' =>'The parent menu field is required',
            'menu_menu_controller.required' => 'The  menu controller field is required.',
            'menu_name.required' => 'The menu name  field is required.',
            'menu_icon.required' => 'The menu icon  field is required.',
            'menu_order.required' => 'The menu order  field is required.',
            'menu_link.required' => 'The menu link field is required.',
        ];
    }
}
