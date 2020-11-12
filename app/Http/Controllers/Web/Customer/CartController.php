<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//custom import
use App\User;
use App\Model\cart;
use App\Model\restaurent_detail;
use App\Model\cart_submenu;
use App\Model\menu_list;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Traits\OtpGenerationTrait;
use Response;
use Session;

class CartController extends Controller
{
    public function index(Request $request){
        return view('customer.cart');
    }

    public function addToCart(Request $request){
        $user = Auth::user();
        $resto_id = base64_decode(request('resto_id'));
        $menu_id = base64_decode(request('menu_id'));
        $restaurent_detail = new restaurent_detail;
        
        $resto_data = $restaurent_detail->getRestoDataOnId($resto_id);
        if($resto_data != NULL)
        {
            $menu_list = new menu_list;
            $menu_data = $menu_list->menuListByID($menu_id);

            if($menu_data != NULL)
            {
                $cart_submenu_data = array();
                $cart = new cart;
                $cart_avail = $cart->checkCartAvaibility($user->id);
                if($cart_avail == NULL){
                    $cart_data = array();
                    $cart_data['user_id'] = $user->id;
                    $cart_data['restaurent_id'] = $resto_id;
                    $cart_data['customer_name'] = $user->name;
                    $cart_data['delivery_fee'] = $resto_data->delivery_charge;
                    $cart_data['tax'] = $resto_data->tax;
                    $cart_id = $cart->makeCart($cart_data);
                    $cart_submenu_data['cart_id'] = $cart_id;

                }
                elseif($cart_avail->restaurent_id == $resto_id)
                {
                    $cart_submenu_data['cart_id'] = $cart_avail->id;
                }
                else
                {
                    $cart_id = $cart->deleteCart($user->id);
                    $cart_data = array();
                    $cart_data['user_id'] = $user->id;
                    $cart_data['restaurent_id'] = $resto_id;
                    $cart_data['customer_name'] = $user->name;
                    $cart_data['delivery_fee'] = $resto_data->delivery_charge;
                    $cart_data['tax'] = $resto_data->tax;
                    $cart_id = $cart->makeCart($cart_data);
                    $cart_submenu_data['cart_id'] = $cart_id;
                }
                $cart_submenu = new cart_submenu;
                $cart_submenu_data['user_id'] = $user->id;
                $cart_submenu_data['menu_id'] = $menu_data->id;
                $cart_id = $cart_submenu->makeCartSubMenu($cart_submenu_data);
                return redirect()->back();
            }
            else{
            Session::flash('modal_message2', 'Inavlid Menu Item !');

            }
            
        }
        else{
            Session::flash('modal_message2', 'Inavlid Restaurent Details !');

        }
        
    }
}
