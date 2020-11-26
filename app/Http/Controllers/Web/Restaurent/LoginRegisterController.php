<?php

namespace App\Http\Controllers\Web\Restaurent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
//custom import
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Traits\OtpGenerationTrait;
use Response;
use Session;

class LoginRegisterController extends Controller
{
    use OtpGenerationTrait;

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6',
            'user_id' => 'required|numeric',
            
        ]);
        if(!$validator->fails()){
            $user_id = $request->input('user_id');
            $password = $request->input('password');
            $mobile_set = "";
            $email_set = "";
            
            if(is_numeric($user_id))
            {
                $loginData =["mobile"=>$user_id,"password"=>$password];
                $mobile_set = $user_id;
            }
            else{
                $loginData =["email"=>$user_id,"password"=>$password];
                $email_set = $user_id;
            }

            if(!auth()->attempt($loginData))
            {
                Session::flash('message', 'Invalid Credentials !'); 
                return redirect()->back()->withInput();
            }
            else{
                $user = Auth::user();
                Session::put('restaurent', $user);
            }

            if($mobile_set != NULL)
            {
                $userid = $mobile_set;
                Session::put('userid', $userid);
                $user_data = auth()->user()->userData($userid);
                if($user_data->mobile_verified_at == NULL)
                {
                    Session::flash('message', 'Please verify your Mobile Number !');
                    $this->OtpGeneration($userid);
                    return redirect('/resendOtp');

                }
                else
                {
                    return redirect('Restaurent/dashboard');
                }
            }
            
        }
        else{
        	return redirect()->back()->withInput()->withErrors($validator);  
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        return redirect('Restaurent/login');
    }
    
    public function resendOtp(Request $request)
    {
        $userid = session('userid');
        Session::flash('message', 'Please verify your Account !');
        $this->OtpGeneration($userid);
        return view('restaurent.auth.verifyOtp');
    }

    public function verifyOtp(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'otp' => 'required|digits:4',
            
            
        ]);
        if(!$validator->fails()){
            $otp=$request->input('otp');
            $data['otp']=$otp;
            $data['userid']=session('userid');
            //dd($data);
            $otp_verified_status=$this->OtpVerification($data);
            
            if($otp_verified_status==2){
                Session::flash('message', 'Invalid OTP');

                return view('restaurent.auth.verifyOtp');

            }
            elseif($otp_verified_status==1){
                $user = Auth::user();
                Session::put('restaurent', $user);
                Session::flash('message', 'Account verified successfully');
                return redirect('Restaurent/dashboard');
            }else{
                return redirect('Restaurent/login');
            }
        
        }
        else{
            //dd($validator);

        	return redirect()->back()->withErrors($validator);  
        }
        
    }
}
