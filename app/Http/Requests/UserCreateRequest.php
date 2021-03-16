<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'email' => 'required|unique:users|email',
            'name' => 'required|min:5',
            'password'=>'required',
            'passwordre'=>'required',
//            'roles[]'=>'required',
            'group'=>'required',
            'job'=>'required',
            'phone'=>'required|numeric',
            'skype'=>'required',
            'address'=>'required',
            'birthday'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'The email field is a required',
            'email.unique' => 'The email field is a unique',
            'email.email' => 'The email field is not formatted correctly',
            'name.required'  => 'The name field is required',
            'name.min'  => 'The name field is 5 characters',
            'password.required'  => 'The password field is required',
            'passwordre.required'  => 'The password field confirmed is required',
//            'roles[].required'  => 'A Roles  is required',
            'group.required' => 'The group field is required',
            'job.required' => 'The job field is required',
            'phone.required' => 'The phone field is required',
            'phone.numeric' => 'The phone field is number',
            'skype.required' => 'The skype field is required',
            'address.required' => 'The address field is required',
            'birthday.required' => 'The birthday field is required',

        ];
    }
}
