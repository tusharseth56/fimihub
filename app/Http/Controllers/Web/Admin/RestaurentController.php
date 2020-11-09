<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//custom import
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Traits\WalletBallanceTrait;
use App\Model\qbeez_wallet_transaction;
use App\Model\user_profile;
use App\Model\qbeez_wallet;
use Response;
use Session;
use DataTables;

class RestaurentController extends Controller
{
    public function RestaurentListDetails(Request $request)
    {
        $user = Auth::user();
        $user['currency']=$this->currency;
    
        return view('admin.addRestaurent')->with(['data'=>$user]);
        
    }

    public function addRestaurentProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:150',
            'password' => 'required|confirmed|string|min:6',
            'mobile' => 'required|numeric|unique:users|digits:10',
            'email' => 'email|unique:users|nullable',
        ]);
        if(!$validator->fails()){
            $data=$request->toArray();
            $data['user_type']=4;
            $user = User::create($data);
                if($user != NULL){
                
                    Session::flash('message', 'Register Succesfully, Please Verify Now!'); 
                    return redirect()->back();
                    
                }else{
                    Session::flash('message', 'Registration Failed , Please try again!'); 
                    return redirect()->back();
                }
            
        }
        else{
        	return redirect()->back()->withInput()->withErrors($validator);  
        }
    }
}
