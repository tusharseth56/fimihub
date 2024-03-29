<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//custom import
use App\User;
use App\Model\cart;
use App\Model\restaurent_detail;
use App\Model\user_address;
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

        $user=Auth::user();
        $user_data = auth()->user()->userByIdData($user->id);

        $user_address = new user_address();
        $user_add = $user_address->getUserAddress($user->id);

        $cart = new cart;
        $cart_avail = $cart->checkCartAvaibility($user->id);

        if($cart_avail == NULL){
            return view('customer.cart')->with(['user_data'=>$user,
                                            'user_address'=>$user_add
                                            ]);
        }
        else
        {
            $restaurent_detail = new restaurent_detail;
            $resto_data = $restaurent_detail->getRestoDataOnId($cart_avail->restaurent_id);

            $cart_submenu = new cart_submenu;
            $quant_details = array();
            $quant_details['user_id']=$user->id;
            $quant_details['cart_id']=$cart_avail->id;
            $quant_details['restaurent_id']=$cart_avail->restaurent_id;
            $cart_menu_data = $cart_submenu->getCartMenuList($quant_details);

            if($cart_menu_data != NULL){
                $total_amount=0;
            $item=0;
            foreach($cart_menu_data as $m_data){
                if($m_data->quantity != NULL){
                    $item = $item + $m_data->quantity;
                    $total_amount = $total_amount + ($m_data->quantity * $m_data->price);
                }
            }
            //add delivery charge and tax in total amount
            $total_amount = ($total_amount - $resto_data->discount) + $resto_data->delivery_charge + $resto_data->tax;
            $user['currency']=$this->currency;
            return view('customer.cartAddress')->with(['user_data'=>$user,
                                                'menu_data'=>$cart_menu_data,
                                                'total_amount'=>$total_amount,
                                                'item'=>$item,
                                                'resto_data'=>$resto_data,
                                                'user_address'=>$user_add
                                                ]);
            }
            else{
                return view('customer.cart')->with(['user_data'=>$user,
                'user_address'=>$user_add
                ]);
            }
            
        }
        
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
                $cart_sub_menu = $cart_submenu->makeCartSubMenu($cart_submenu_data);
                
                $get_qaunt = array();
                $get_quant['cart_id'] = $cart_submenu_data['cart_id'];
                $get_quant['menu_id'] = $menu_data->id;
                $cart_sub_menu = $cart_submenu->getCartValue($cart_submenu_data);

                $menu_list = new menu_list;
                $quant_details = array();
                $quant_details['user_id']=$user->id;
                $quant_details['restaurent_id']=$resto_id;
        
                $menu_data = $menu_list->menuListByQuantity($quant_details);
                
                $total_amount=0;
                $item=0;
                foreach($menu_data as $m_data){
                    if($m_data->quantity != NULL){
                        $item = $item + $m_data->quantity;
                        $total_amount = $total_amount + ($m_data->quantity * $m_data->price);
                    }
                }

                $response = ['quantity'=>$cart_sub_menu->quantity,
                            'items'=>$item,
                            'total_amount' => $total_amount];

                return ($response);
            }
            else{
            Session::flash('modal_message2', 'Inavlid Menu Item !');

            }
            
        }
        else{
            Session::flash('modal_message2', 'Inavlid Restaurent Details !');

        }
        
    }

    public function removeFromCart(Request $request){
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
                
                $cart_submenu = new cart_submenu;
                $cart_submenu_data['user_id'] = $user->id;
                $cart_submenu_data['menu_id'] = $menu_data->id;
                $cart_sub_menu = $cart_submenu->removeCartSubMenu($cart_submenu_data);
                
                $get_qaunt = array();
                $get_quant['cart_id'] = $cart_submenu_data['cart_id'];
                $get_quant['menu_id'] = $menu_data->id;
                $cart_sub_menu = $cart_submenu->getCartValue($cart_submenu_data);
                if($cart_sub_menu == NULL)
                {
                    $menu_list = new menu_list;
                    $quant_details = array();
                    $quant_details['user_id']=$user->id;
                    $quant_details['restaurent_id']=$resto_id;
            
                    $menu_data = $menu_list->menuListByQuantity($quant_details);
                    
                    $total_amount=0;
                    $item=0;
                    foreach($menu_data as $m_data){
                        if($m_data->quantity != NULL){
                            $item = $item + $m_data->quantity;
                            $total_amount = $total_amount + ($m_data->quantity * $m_data->price);
                        }
                    }
                    $response = ['quantity'=>0,
                                'items'=>$item,
                                'total_amount' => $total_amount];

                    return $response;
                }
                else
                {
                    $menu_list = new menu_list;
                    $quant_details = array();
                    $quant_details['user_id']=$user->id;
                    $quant_details['restaurent_id']=$resto_id;
            
                    $menu_data = $menu_list->menuListByQuantity($quant_details);
                    
                    $total_amount=0;
                    $item=0;
                    foreach($menu_data as $m_data){
                        if($m_data->quantity != NULL){
                            $item = $item + $m_data->quantity;
                            $total_amount = $total_amount + ($m_data->quantity * $m_data->price);
                        }
                    }

                    $response = ['quantity'=>$cart_sub_menu->quantity,
                                'items'=>$item,
                                'total_amount' => $total_amount];

                    return ($response);

                }
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
