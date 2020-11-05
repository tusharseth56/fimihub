<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//user import section
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;

class UserStoreRequest extends FormRequest
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
            'name' => 'required|string|max:150',
            'password' => 'required|string|min:6',
            'mobile' => 'required|numeric|unique:users|digits:10',
            'user_type' => 'required|in:1,2,3', //1-Admin,2-Merchant,3-User	
            'country_code' => 'string|nullable', //1-Admin,2-Merchant,3-User	
            'email' => 'email|unique:users',
            'device_token' => 'required|string',
            
            
        ];
        return $validator;

        
    }
    
    
}
