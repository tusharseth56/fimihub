<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//custom import
use App\User;
use App\Model\subscribe;
use App\Model\restaurent_detail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Traits\OtpGenerationTrait;
use Response;
use Session;

class DashboardController extends Controller
{
    public function index(Request $request){
        $user=Auth::user();
        $user_data = auth()->user()->userByIdData($user->id);
        $restaurent_detail = new restaurent_detail;
        $resto_data = $restaurent_detail->getallRestoData();
        return view('customer.home')->with(['user_data'=>$user_data,'resto_data'=>$resto_data]);
    }

    public function subscribe(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            
            
        ]);
        if(!$validator->fails()){
            
            $data = $request->toarray();
            $subscribe = new subscribe;
            $subscribe = $subscribe->makeSubscription($data);
            Session::flash('modal_check_subscribe', 'open'); 
            Session::flash('modal_message', 'Successfully Subscribed !');

            return redirect()->back();
        }else{
        	return redirect()->back()->withInput()->withErrors($validator);  
        }
    }
}
