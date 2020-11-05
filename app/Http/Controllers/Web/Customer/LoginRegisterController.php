<?php

namespace App\Http\Controllers\Web\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
//custom import
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Traits\OtpGenerationTrait;
use App\Model\qbeez_wallet;
use Response;
use Session;
use App\Model\merchant_detail;


class LoginRegisterController extends Controller 
{
    use OtpGenerationTrait;

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:150',
            'password' => 'required|string|min:6',
            'mobile' => 'required|numeric|unique:users|digits:10',
            'terms'=> 'required',
        ]);
        if(!$validator->fails()){
            $data=$request->toArray();
            $data['user_type']=2;
            $user = User::create($data);
                if($user != NULL){
                    $business_data=array();
                    $business_data['user_id']=$user->id;
                    $business_data['business_name']='--';
                    $merchant_detail = new merchant_detail();
                    $merchant_detail = $merchant_detail->insertUpdateMerchantData($business_data);

                    $wallet_data=array();
                    $wallet_data['user_id']=$user->id;
                    $wallet_data['user_type']=2;
                    $wallet_data['wallet_type']=1;
                    $qbeez_wallet = new qbeez_wallet();
                    $qbeez_wallet = $qbeez_wallet->qbzWalletData($user->id);
                
                    if($qbeez_wallet == NULL)
                    {
                        $qbeez_wallet = new qbeez_wallet();
                        $qbeez_wallets = $qbeez_wallet->makeQbzWallet($wallet_data);
                    
                    }
                    Session::flash('message', 'Register Succesfully , Please Login Now!'); 
                    return redirect('merchant/login');
                    
                }else{
                    Session::flash('message', 'Registration Failed , Please try again!'); 
                    return redirect()->back();
                }
            
            }
        else{
        	return redirect()->back()->withInput()->withErrors($validator);  
        }
    }
    
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6',
            'user_id' => 'required',
            
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
                Session::put('user', $user);
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
                    return redirect('merchant/verify');
                }
                else
                {
                    return redirect('merchant/dashboard');
                }
            }
            else
            {
                $userid = $email_set;
                Session::put('userid', $userid);
                $user_data = auth()->user()->userData($userid);
                if($user_data->email_verified_at == NULL)
                {
                    Session::flash('message', 'Please verify your Email-ID !');
                    $this->OtpGeneration($userid);
                    return redirect('merchant/verify');
                }
                else
                {
                    return redirect('merchant/dashboard');
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
        Session::flush(['user','userid']);
        return redirect('/merchant/login');
    }
    
    public function resendOtp(Request $request)
    {
        $userid = session('userid');
        Session::flash('message', 'Please verify your Account !');
        $this->OtpGeneration($userid);
        return redirect('merchant/verify');
    }
    public function verifyOtp(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'otp' => 'required|digits:6',
            
        ]);
        if(!$validator->fails()){
            
            $data['otp']=$request->input('otp');
            $data['userid']=session('userid');
            $otp_verified_status=$this->OtpVerification($data);
            if($otp_verified_status==2){
                return redirect('merchant/verify');
            }
            elseif($otp_verified_status==1){
                return redirect('merchant/businessForm');
            }else{
                return redirect('merchant/logout');
            }
        
        }
        else{
        	return redirect()->back()->withErrors($validator);  
        }
        
    }

    public function forgetPasswordProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userid' => 'required',
            
        ]);
        if(!$validator->fails()){
            $userid = $request->input('userid');
            Session::put('user_id_temp', $userid);
            $user = new User();
            $user_data = $user->userData($userid);
            
            $data=['user_id_temp'=>$userid];
            //dd($user_data);
            if($user_data != NULL )
            {
                $otp_verified_status=$this->OtpGenerationForgetPassword($data);

                if($otp_verified_status==2){
                    return redirect('merchant/forgetPassword');
                }
                elseif($otp_verified_status==1){
                    return redirect('merchant/passwordChangeVerification');
                }
                return response()->json(['message' => 'Password Changed'], $this->successStatusCreated);
            }
            Session::flash('message', 'Invalid User Id');
            return redirect('merchant/forgetPassword');
        }else{
        	return redirect()->back()->withInput()->withErrors($validator);  
        }
        
    }

    public function forgetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'verification_code'=>'required|digits:4',
            'password'=>'required|confirmed|min:6',
            
        ]);
        if(!$validator->fails()){
            $userid = session('user_id_temp');
            $verification_code = $request->input('verification_code');
            $password = $request->input('password');
            $user = new User();
            $user_data = $user->userData($userid);
            
            $data=['userid'=>$userid,'password'=>$password];
            if($user_data != NULL ){
                if($user_data->verification_code == $verification_code){
                    $user = new User();
                    $user->changePassword($data);
                    $user_data = User::find($user_data->id);
                    $user_data->verification_code = NULL;
                    $user_data->save();
                    Session::flash('message', 'Password Changed ,Please Login');
                    return redirect('merchant/login');
                }else{
                    Session::flash('message', 'Invalid OTP');
                    return redirect('merchant/forgetPassword');
                }

            }
            Session::flash('message', 'Invalid User Id');
            return redirect('merchant/forgetPassword');
        }else{
        	return redirect()->back()->withInput()->withErrors($validator);  
        }
    }

}