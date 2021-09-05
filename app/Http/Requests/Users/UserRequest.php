<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
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
    public function rules(Request $request)
    {
        if ($this->method() == 'PUT') {
            $post_id = $this->segment(2);
            $rules = [
                'user_type_id' => 'required',
                'full_name' => 'required|regex:/[A-Za-z. -]/|min:3|max:40',
                'avatar_image' => 'mimes:jpeg,jpg,png|max:1048',
                'email' => 'required|unique:users,email,' . $post_id,
                'login_user_name' => 'required|min:4|max:40|unique:users,login_user_name,' . $post_id
            ];
        } else {
            if($request->update_status =='1'){

                $rules = [
                    'full_name' => 'required|regex:/[A-Za-z. -]/|min:3|max:200'
                ];

            }elseif($request->update_status =='2'){
                $rules = [
                    'email' => 'required|unique:users,email,' . Auth::user()->id,
                    'login_user_name' => 'required|min:4|max:40|unique:users,login_user_name,' . Auth::user()->id

                ];
            }else{
                $rules = [
                    'user_type_id' => 'required',
                    'full_name' => 'required|regex:/[A-Za-z. -]/|min:3|max:40',
                    'avatar_image' => 'mimes:jpeg,jpg,png||max:1048',
                    'email' => 'required|unique:users,email',
                    'login_user_name' => 'required|min:3|max:40|unique:users,login_user_name',

                ];
            }

        }
        return $rules;
    }
    public function messages()
    {
        return [
            'user_type_id.required' => 'The  user type name field is required.',
            'full_name.required' => 'The full name  field is required.',
            'user_status.required' => 'The status field is required.',
            'avatar_image.mimes' => 'The user image must be a file of type: jpeg, jpg, png.',
            'avatar_image.max' => 'Image size must be 1 MB !',
            'email.required' =>'The email address field is required!',
            'email.unique' =>'This  email address already taken. Please try another!',
            'login_user_name.required' =>'The user name field is required.',
            'login_user_name.unique' =>'This  user name already taken. Please try another!',
            'login_user_name.min' =>'The user name  at least 4 length.',
            'name.min' =>'The  name  at least 4 length.',
            'login_user_name.max' =>'The user name must be 40 length.',


        ];
    }
}
