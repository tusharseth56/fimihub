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
use App\Model\order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Traits\OtpGenerationTrait;
use Response;
use Session;

class OrderController extends Controller
{
    public function getPaymentPage(Request $request)
    {
        $user=Auth::user();
        $user_data = auth()->user()->userByIdData($user->id);
        $user_address = new user_address();
        $user_default_add = $user_address->getDefaultAddress($user->id);

        if($user_default_add !=NULL){

            $user_address = new user_address();
            $user_add = $user_address->getUserAddress($user->id);

            $cart = new cart;
            $cart_avail = $cart->checkCartAvaibility($user->id);
            $upadte_cart = array();
            $upadte_cart['id']= $cart_avail->id;
            $upadte_cart['address_id']= $user_default_add->id;
            $update_cart_add = $cart->updateCart($upadte_cart);

            if($cart_avail == NULL){
                return view('customer.cart')->with(['user_data'=>$user,
                                                'user_address'=>$user_add
                                                ]);;
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
                    return view('customer.cartPayment')->with(['user_data'=>$user,
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
                    ]);;
                }
                
            }
        }
        else{
            Session::flash('message', 'Please Select Any Address');
            return redirect()->back();

        }
        
        
    }

    public function addPaymentType(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'payment' => 'required|in:1,2,3',
                
        ]);
        if(!$validator->fails()){
            $user = Auth::user();

            $cart = new cart;
            $cart_avail = $cart->checkCartAvaibility($user->id);

            $cart_submenu = new cart_submenu;
            $quant_details = array();
            $quant_details['user_id']=$user->id;
            $quant_details['cart_id']=$cart_avail->id;
            $quant_details['restaurent_id']=$cart_avail->restaurent_id;
            $cart_menu_data = $cart_submenu->getCartMenuList($quant_details);

            if($cart_menu_data != NULL){
                $total_amount=0;
                $item=0;

                $restaurent_detail = new restaurent_detail;
                $resto_data = $restaurent_detail->getRestoDataOnId($cart_avail->restaurent_id);

                foreach($cart_menu_data as $m_data){
                    if($m_data->quantity != NULL){
                        $item = $item + $m_data->quantity;
                        $total_amount = $total_amount + ($m_data->quantity * $m_data->price);
                    }
                }
                //add delivery charge and tax in total amount
                $total_amount = ($total_amount - $resto_data->discount) + $resto_data->delivery_charge + $resto_data->tax;
                $user['currency']=$this->currency;

                $orders = new order;
                $add_order = array();
                $add_order['user_id'] = $user->id;
                $add_order['restaurent_id'] = $cart_avail->restaurent_id;
                $add_order['cart_id'] = $cart_avail->id;
                $add_order['address_id'] = $cart_avail->address_id;
                $add_order['customer_name'] =  $user->name;
                $add_order['ordered_menu'] = json_encode($cart_menu_data);
                $add_order['mobile'] =  $user->mobile;
                $add_order['total_amount'] = $total_amount;
                $add_order['delivery_fee'] = $cart_avail->delivery_fee;
                $add_order['tax'] = $cart_avail->tax;
                $add_order['order_status'] = 1;
                $add_order['payment_status'] = 1;
                $add_order['payment_type'] = request('payment');
                $make_order = $orders->makeOrder($add_order);
                $cart_delete = $cart->deleteCart($user->id);

                Session::flash('modal_check_order', 'open');

                return redirect('/home');
            }
            else{

            }
            
        }
        else{

        	return redirect()->back()->withInput()->withErrors($validator);  
        }
    }
}
