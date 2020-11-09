<?php

namespace App\Http\Controllers\Web\Restaurent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//custom import
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Response;
use Session;

class DashboardController extends Controller
{

    public function dashboardDetails()
    {
        $user = Auth::user();
        $user_instance = new User;
        $user_count = $user_instance->allUserList(3)->count();
        $merchant_count = $user_instance->allUserList(2)->count();
        $user['currency']=$this->currency;
        $user['user_count']=$user_count;
        $user['merchant_count']=$merchant_count;
        //dd($user);
        return view('restaurent.indexDashboard')->with(['data'=>$user]);
        
    }
}
