<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//custom import
use App\User;
use App\Model\restaurent_detail;
use App\Model\menu_list;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Traits\OtpGenerationTrait;
use Response;
use Session;

class RestaurentController extends Controller
{
    public function getRestaurentDetails(Request $request)
    {
        $user = Auth::user();
        $resto_id = base64_decode(request('resto_id'));
        $restaurent_detail = new restaurent_detail;
        $resto_data = $restaurent_detail->getRestoDataOnId($resto_id);
        $menu_list = new menu_list;
        $menu_data = $menu_list->menuList($resto_id);
        $menu_cat = $menu_list->menuCategory($resto_id);
        return view('customer.menuList')->with(['menu_data'=>$menu_data,'menu_cat'=>$menu_cat,'resto_data'=>$resto_data]);
    }
}
