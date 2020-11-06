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
use File;

class UserController extends Controller
{
    public function index(Request $request){
        $user=Auth::user();
        $user_data = auth()->user()->userByIdData($user->id);
        return view('customer.myAccount')->with(['user_data'=>$user_data]);
    }

    public function updateProfile(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'string|max:150',
                'email' => 'email|nullable',
                'picture' => 'mimes:png,jpg,jpeg|max:3072|nullable',
                
            ]);
            if(!$validator->fails()){
            $user = Auth::user();
            $id = $user->id;
            $data = $request->toarray();
            $data['id']= $id;
            $user_instance = new User;
            $user_data = $user_instance->userByIdData($data['id']);
            $user_update_data=array();
            $user_update_data['id']=$id;
            if($request->has('password'))
            {
                unset($data['password']);
            }
            if($request->has('email')){
                if($data['email'] == $user_data->email){
                    $ab=1;
                }else{
                    $user_update_data['email']=$data['email'];
                    $user_update_data['email_verified_at']=NULL;
                }
            }

            if($request->has('mobile')){
                if($data['mobile'] == $user_data->email){
                    $ab=1;
                }else{
                    $user_update_data['mobile']=$data['mobile'];
                    $user_update_data['mobile_verified_at']=NULL;
                }
            }
            if($request->has('name')){
                $user_update_data['name']=$data['name'];
            }
            if($request->hasfile('picture'))
            {
                $profile_pic = $request->file('picture');
                $input['imagename'] = 'ProfilePicture'.time().'.'.$profile_pic->getClientOriginalExtension();

                $path = public_path('uploads/'.$id.'/images');
                File::makeDirectory($path, $mode = 0777, true, true);
                                
                $destinationPath = 'uploads/'.$id.'/images'.'/';
                if($profile_pic->move($destinationPath, $input['imagename']))
                {
                    $file_url=url($destinationPath.$input['imagename']);
                    $user_update_data['picture']=$file_url;
                
                }else{
                    $error_file_not_required[]="Profile Picture Have Some Issue";
                    $user_update_data['picture']="";
                }
                
            }
            $user = auth()->user()->UpdateLogin($user_update_data);
            $user_data = auth()->user()->userByIdData($id);
            unset($user_data->password);
            // dd($user_data);
            Session::flash('modal_message', 'Profile Updated !');

            Session::flash('modal_check_subscribe', 'open');
            return redirect()->back();
            
        }
        else{
            return redirect()->back()->withInput()->withErrors($validator);  
        }
        } catch (\Throwable $th) {
            report($th);
            
            return response()->json(['message'=> $th->getMessage(),'status'=>false], $this->invalidStatus);

        }

        
    }
}
