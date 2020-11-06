<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\DB;


class User extends Authenticatable
{
    use  Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile','status','user_type','role','permission','verification_code','country_code','device_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','permission','status','visibility','created_at','deleted_at','updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        if( \Hash::needsRehash($value) ) {
            $value = \Hash::make($value);
            
        }
    $this->attributes['password'] = $value;
    }

    public function userData($userid)
    {
        try {
            $user_data=DB::table('users')
                ->where('mobile', $userid)
                ->orWhere('email',$userid)
                ->first();
            unset($user_data->password);
            return $user_data;
        }
        catch (Exception $e) {
            dd($e);
        }
    }

    

    public function generateOTP($userid)
    {
        $otp = mt_rand(1000,9999);
        $data=array('verification_code'=>$otp);
        DB::table('users')
            ->where('mobile', $userid)
            ->orWhere('email',$userid)
            ->update($data);
        
        return $otp;
    }
    public function changePassword($data)
    {
        $value = \Hash::make($data['password']);
        $pass=array('password'=> $value);
        $pass['updated_at'] = now();
        $result = DB::table('users')
            ->where('mobile', $data['userid'])
            ->orWhere('email',$data['userid'])
            ->update($pass);
        
        return $result;
    }

    public function UpdateLogin($data)
    {
        $value=DB::table('users')->where('id', $data['id'])->get();
        
        if($value->count() == 0)
        {
            return 0;
            
        }
        else
        {
            $data['updated_at'] = now();
            
            $query_data = DB::table('users')
                        ->where('id', $data['id'])
                        ->update($data);
            $query_type="update";
            
        }
        
        return $query_data;
    }

    public function userByIdData($id)
    {
        try {
            $user_data=DB::table('users')
                ->where('id', $id)
                ->first();
            unset($user_data->password);
            return $user_data;
        }
        catch (Exception $e) {
            dd($e);
        }
    }

    public function allUserList($user_type)
    {
        try {
            $user_data=DB::table('users')
                ->where('visibility', 0)
                ->where('user_type', $user_type)
                ->get();
            
            return $user_data;
        }
        catch (Exception $e) {
            dd($e);
        }
    }

    public function allUserPaginateList($user_type)
    {
        try {
            $user_data=DB::table('users')
                ->where('visibility', 0)
                ->where('user_type', $user_type)
                ->orderBy('created_at','DESC');
            
            
            return $user_data;
        }
        catch (Exception $e) {
            dd($e);
        }
    }

}
