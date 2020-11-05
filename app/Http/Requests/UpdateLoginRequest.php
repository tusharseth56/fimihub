<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLoginRequest extends FormRequest
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
        $validator = [
            'name' => 'string|max:150',
            'email' => 'string|email|max:255|unique:users|nullable',
            'mobile' => 'numeric|unique:users|digits:10',
            'dob' => 'string|nullable',
            'profile_picture' => 'mimes:png,jpg,jpeg|max:3072|nullable',
            'gender' => 'numeric|nullable',
        
        ];
        return $validator;
    }
}
