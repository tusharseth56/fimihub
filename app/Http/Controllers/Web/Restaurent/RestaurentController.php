<?php

namespace App\Http\Controllers\Web\Restaurent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
//custom import
use App\Model\restaurent_detail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Traits\OtpGenerationTrait;
use Response;
use Session;

class RestaurentController extends Controller
{
    public function accountDetails()
    {
        $user = Auth::user();
        $restaurent_detail = new restaurent_detail;
        $resto_data = $restaurent_detail->getRestoData($user->id);
        
        //dd($user);
        return view('restaurent.myDetails')->with(['data'=>$user,'resto_data'=>$resto_data]);
        
    }

    public function addRestaurentDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|nullable',
            'about' => 'string|nullable',
            'other_details' => 'string|nullable',    
            'picture' => 'mimes:png,jpg,jpeg|max:3072|nullable',    
            'official_number' => 'numeric|nullable',    
            'avg_cost' => 'numeric|nullable',    
            'avg_time' => 'string|nullable',    
            'open_time' => 'string|nullable',    
            'close_time' => 'string|nullable',    
            'address' => 'string|nullable',    
            'delivery_charge' => 'string|nullable',    
            'pincode' => 'string|nullable',    
            'resto_type' => 'in:1,2,3|nullable',    
            
        ]);
        if(!$validator->fails()){
            $user = Auth::user();
            $data = $request->toarray();
            $data['user_id'] =$user->id;
            $restaurent_detail = new restaurent_detail;
            if($request->hasfile('picture'))
            {
                $profile_pic = $request->file('picture');
                $input['imagename'] = 'RestaurentProfilePicture'.time().'.'.$profile_pic->getClientOriginalExtension();

                $path = public_path('uploads/'.$id.'/images');
                File::makeDirectory($path, $mode = 0777, true, true);
                                
                $destinationPath = 'uploads/'.$id.'/images'.'/';
                if($profile_pic->move($destinationPath, $input['imagename']))
                {
                    $file_url=url($destinationPath.$input['imagename']);
                    $data['picture']=$file_url;
                
                }else{
                    $error_file_not_required[]="Profile Picture Have Some Issue";
                    unset($data['picture']);
                }
                
            }
            else{
                unset($data['picture']);
            }
        
            $resto_id = $restaurent_detail->insertUpdateRestoData($data);
            Session::flash('message', 'Restaurent Data Updated !');

            return redirect()->back();

        }
        else{
        	return redirect()->back()->withInput()->withErrors($validator);  
        }
        
    }
}
