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
            'mobile' => 'numeric|unique:users|digits:10',
            'country_code' => 'string|nullable',	
            'email' => 'email|unique:users|nullable',
            'vehicle_number' => 'string',
            'model_name' => 'string',
            'vehicle_image' => 'mimes:png,jpg,jpeg|max:3072|nullable',
            'color' => 'string',
            'id_proof' => 'mimes:pdf|max:3072',
            'address' => 'string',
            'pincode' => 'digits:6',
            'driving_license' => 'mimes:png,jpg,jpeg|max:3072',
            'dl_start_date' => 'string',
            'dl_end_date' => 'string',
            'registraion_start_date' => 'string',
            'registraion_end_date' => 'string',
            'account_number' => 'string',
            'holder_name' => 'string|max:150',
            'branch_name' => 'string|max:150',
            'ifsc_code' => 'string',
        
        ];
        return $validator;
    }
}
