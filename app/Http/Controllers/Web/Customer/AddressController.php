<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//custom import
use App\User;
use App\Model\user_address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Traits\OtpGenerationTrait;
use Response;
use Session;

class AddressController extends Controller
{
    public function insertAddress(Request $request){

        $validator = Validator::make($request->all(), [
            'address' => 'required|string',
            'flat_no' => 'required|string',
            'landmark' => 'required|string',
            
            
        ]);
        if(!$validator->fails()){
            $user = Auth::user();
            $data = $request->toarray();
            $data['user_id']=$user->id;
            $user_address = new user_address;
            $subscribe = $user_address->makeAddress($data);
            Session::flash('modal_message', 'Address Saved !');

            Session::flash('modal_check_subscribe', 'open');
            return redirect()->back();
        }else{
        	return redirect()->back()->withInput()->withErrors($validator);  
        }
    }
}
