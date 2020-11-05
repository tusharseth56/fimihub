<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//custom import
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UpdateLoginRequest;
use App\Http\Requests\UserForgetPasswordRequest;
use App\Http\Requests\UpdateDeviceTokenRequest;
use App\Http\Traits\OtpGenerationTrait;
use Response;
use App\Model\qbeez_wallet;
use App\Model\merchant_detail;
use App\Model\user_profile;
use File;


class LoginRegisterController extends Controller
{
    use OtpGenerationTrait;
    public function register(UserStoreRequest $request)
    {
    
        try {
            $data=$request->toArray();
            $data['visibility']=1; //inactive account
            $user = User::create($data);
            
            if($data['user_type'] == 2)
            {
                $business_data=array();
                $business_data['user_id']=$user->id;
                $business_data['business_name']='--';
                $merchant_detail = new merchant_detail();
                $merchant_detail = $merchant_detail->insertUpdateMerchantData($business_data);
            }
            
            $wallet_data=array();
            $wallet_data['user_id']=$user->id;
            $wallet_data['user_type']=$data['user_type'];
            $wallet_data['wallet_type']=1;
            $qbeez_wallet = new qbeez_wallet();
            $qbeez_wallet = $qbeez_wallet->qbzWalletData($user->id);
        
            if($qbeez_wallet == NULL)
            {
                $qbeez_wallet = new qbeez_wallet();
                $qbeez_wallets = $qbeez_wallet->makeQbzWallet($wallet_data);
                $wallet_data = ($qbeez_wallet->qbzWalletData($wallet_data['user_id']));
            }

            $user_ins = new user();
            $user_data = $user_ins->userByIdData($user->id);
            unset($user_data->password);
            if($user_data->visibility != 2)
            {
                if($user_data->mobile_verified_at != NULL)
                {
                    $response = ['data' => $user_data,
                                'wallet_data'=>$wallet_data,
                                'status'=>true,
                                'message'=>'Registered','verified'=>true];
                    return response()->json($response, $this->successStatusCreated);
                }
                else{
                    $otp=$this->OtpGeneration($user_data->mobile);
                    $user_data = $user_ins->userByIdData($user->id);
                   // $user_data->verification_code=$otp;
                    $response = ['data' => $user_data,
                                'wallet_data'=>$wallet_data,
                                'status'=>true,
                                'message'=>'Not Verified','verified'=>false];
                    return response()->json($response, $this->successStatusCreated);
                }
            }
            else{
                $response = ['status'=>false,'message'=>'Please Contact Admin (Temporary Blocked)'];
                return response()->json($response, $this->failureStatus);
            }
            
            
        } catch (\Throwable $th) {
            report($th);
            
            return response()->json(['message'=> $th->getMessage(),'status'=>false], $this->invalidStatus);

        }

        
    }

    public function login(UserLoginRequest $request)
    {
        try 
        {

            $user_id = $request->input('userid');
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
                return response()->json(['message'=>'Invalid Credentials','status'=>false],$this->failureStatus);
            }
            
            //CHECK VERIFICATION DONE OR NOT
            $accessToken = auth()->user()->createToken('teckzy')->accessToken;
            if($mobile_set != NULL)
            {
                $userid = $mobile_set;
                $user_data = auth()->user()->userData($userid);
                $qbeez_wallet = new qbeez_wallet();
                $wallet_data = ($qbeez_wallet->qbzWalletData($user_data->id));
                unset($user_data->password);
                if($user_data->mobile_verified_at == NULL)
                {
                    $otp=$this->OtpGeneration($user_data->mobile);
                    $user_data->access_token=$accessToken;
                    return response()->json(['verified'=>false,
                                            'data'=>$user_data,
                                            'wallet_data'=>$wallet_data,
                                            'status'=>true], $this->successStatus);
                }
                else
                {
                    $user_data->access_token=$accessToken;
                    return response()->json(['verified'=>true,
                                            'data'=>$user_data ,
                                            'wallet_data'=>$wallet_data,
                                            'status'=>true], $this->successStatus);
                }
            }
            else
            {
                $userid = $email_set;
                $user_data = auth()->user()->userData($userid);
                $qbeez_wallet = new qbeez_wallet();
                $wallet_data = ($qbeez_wallet->qbzWalletData($user_data->id));
                unset($user_data->password);
                
                if($user_data->email_verified_at == NULL)
                {
                    $user_data->access_token=$accessToken;
                    return response()->json(['verified'=>false,
                                            'data'=>$user_data ,
                                            'wallet_data'=>$wallet_data,
                                            'status'=>true], $this->successStatus);
                }
                else
                {
                    $user_data->access_token=$accessToken;
                    return response()->json(['verified'=>true,
                                            'data'=>$user_data ,
                                            'wallet_data'=>$wallet_data,
                                            'status'=>true], $this->successStatus);
                }
            }
        }
            catch (\Throwable $th) 
        {
            report($th);
        
            return response()->json(['message'=> $th->getMessage(),'status'=>false], $this->invalidStatus);

        }
    
    }


    public function details()
    {   
        $user = Auth::user();
        
        $wallet_data=array();
        $wallet_data['user_id']=$user->id;
        $wallet_data['user_type']=$user->user_type;
        $wallet_data['wallet_type']=1;
        $qbeez_wallet = new qbeez_wallet();
        $qbeez_wallets = $qbeez_wallet->qbzWalletData($user->id);
    
        if($qbeez_wallet == NULL)
        {
            $qbeez_wallet = new qbeez_wallet();
            $qbeez_wallets = $qbeez_wallet->makeQbzWallet($wallet_data);
            
        }
        unset($user->password);
        $wallet_data = ($qbeez_wallet->qbzWalletData($wallet_data['user_id']));
        return response()->json(['data' => $user,'wallet_data'=>$wallet_data,'status'=>true], $this->successStatus);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Successfull Logout','status'=>true], 200);
    }

    public function forgetPassword(UserForgetPasswordRequest $request)
    {
        try 
        {
            $userid = $request->input('userid');
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
                    return response()->json(['message' => 'Password Changed','status'=>true], $this->successStatusCreated);
                }else{
                    return response()->json(['message' => 'Invalid OTP','status'=>false], $this->failureStatus);
                }

            }
            return response()->json(['message' => 'Invalid User-Id','status'=>false], $this->failureStatus);
        }
        catch (\Throwable $th) 
        {
            report($th);
        
            return response()->json(['message'=> $th->getMessage(),'status'=>false], $this->invalidStatus);

        }
    }

    
    public function updateLogin(UpdateLoginRequest $request)
    {
        try {
            $user = Auth::user();
            $id = $user->id;
            $data = $request->toarray();
            $data['id']= $id;
            $email = $mobile = "";
            $user_update_data=array();
            $user_update_data['id']=$id;
            if($request->has('password'))
            {
                unset($data['password']);
            }
            if($request->has('email')){
                $user_update_data['email']=$data['email'];
                $user_update_data['email_verified_at']=NULL;
            }

            if($request->has('mobile')){
                $user_update_data['mobile']=$data['mobile'];
                $user_update_data['mobile_verified_at']=NULL;
            }
            if($request->has('name')){
                $user_update_data['name']=$data['name'];
            }
            $user = auth()->user()->UpdateLogin($user_update_data);
            $user_data = auth()->user()->userByIdData($id);
            unset($user_data->password);

            $profile_data=array();
            $profile_data['user_id']=$id;
            if($request->has('dob')){
                $profile_data['dob']=$data['dob'];
            }
            if($request->hasfile('profile_picture'))
            {
                $profile_pic = $request->file('profile_picture');
                $input['imagename'] = 'ProfilePicture'.time().'.'.$profile_pic->getClientOriginalExtension();

                $path = public_path('uploads/'.$id.'/images');
                File::makeDirectory($path, $mode = 0777, true, true);
                                
                $destinationPath = 'uploads/'.$id.'/images'.'/';
                if($profile_pic->move($destinationPath, $input['imagename']))
                {
                    $file_url=url($destinationPath.$input['imagename']);
                    $profile_data['profile_picture']=$file_url;
                
                }else{
                    $error_file_not_required[]="Profile Picture Have Some Issue";
                    $profile_data['profile_picture']="";
                }
                
            }
            if($request->has('gender')){
                $profile_data['gender']=$data['gender'];
            }
            $user_profile = new user_profile();
            $profile_data_update = $user_profile->insertUpdateProfileData($profile_data);
            $profile_data = $user_profile->profileData($profile_data);

            return response()->json(['data' =>$user_data,
                                    'profile_data'=>$profile_data,
                                    'message' =>'Profile Updated !',
                                    'status'=>true], $this->successStatusCreated);
        } catch (\Throwable $th) {
            report($th);
            
            return response()->json(['message'=> $th->getMessage(),'status'=>false], $this->invalidStatus);

        }

        
    }
    public function updateDeviceToken(UpdateDeviceTokenRequest $request)
    {
        try {
            $user = Auth::user();
            $id = $user->id;
            $data = $request->toarray();
            $data['id']= $id;
            $email = $mobile = "";
            $user_update_data=array();
            $user_update_data['id']=$id;
            
            if($request->has('device_token')){
                $user_update_data['device_token']=$data['device_token'];
            }
            $user = auth()->user()->UpdateLogin($user_update_data);
            $user_data = auth()->user()->userByIdData($id);
            unset($user_data->password);

            
            
            return response()->json(['data' =>$user_data,
                                    'message' =>'Token Updated !',
                                    'status'=>true], $this->successStatusCreated);
        } catch (\Throwable $th) {
            report($th);
            
            return response()->json(['message'=> $th->getMessage(),'status'=>false], $this->invalidStatus);

        }

        
    }


}
