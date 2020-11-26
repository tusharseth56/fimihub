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
use App\Model\restaurent_detail;
use App\Model\order;
use Response;
use Session;
use DataTables;


class OrderController extends Controller
{
    public function getCustomerOrderList(Request $request)
    {
        $user = Auth::user();

        $restaurent_detail = new restaurent_detail;
        $resto_data = $restaurent_detail->getRestoData($user->id);

        $orders = new order;
        $order_data = $orders->customerOrderPaginationData($resto_data->id);

        if ($request->ajax()) {      
            return Datatables::of($order_data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="userDetails?id='.base64_encode($row->id).'" class="btn btn-outline-dark btn-sm btn-round waves-effect waves-light m-0">Details</a> 
                        <a href="?id='.base64_encode($row->id).'" class="btn btn-outline-danger btn-sm btn-round waves-effect waves-light m-0">Block</a>';
                    return $btn;
                })
                ->addColumn('created_at', function($row){         
                    return date('d F Y', strtotime($row->created_at));
                })
                ->addColumn('payment_type', function($row){         
                    if($row->payment_type == 1){
                        return "Stripe";
                    }
                    elseif($row->payment_type == 2){
                        return "Paypal";
                    }
                    elseif($row->payment_type == 3){
                        return "COD";
                    }
                    else{
                        return "N.A";
                    }
                })
                ->addColumn('order_status', function($row){   
                    
                    if($row->order_status == 3){
                        return "Restaurent Approval Needed";
                    }
                    elseif($row->order_status == 5){
                        return "Order Placed";
                    }
                    elseif(in_array($row->order_status,array(2,4,8))){
                        return "Order Cancelled";
                    }
                    elseif($row->order_status == 6){
                        return "Order Packed";
                    }
                    elseif($row->order_status == 7){
                        return "Order Picked";
                    }
                    elseif($row->order_status == 9){
                        return "Order Recieved";
                    }
                    elseif($row->order_status == 10){
                        return "Order Refunded";
                    }
                    else{
                        return "N.A";
                    }
                })
                ->addColumn('ordered_menu', function($row){
                    $order_menu=""; 
                    $loop_count = 1;  
                    $row->ordered_menu = json_decode($row->ordered_menu);

                    foreach($row->ordered_menu as $ordered_menu){
                        if($loop_count == 1)
                        {
                           $order_menu .= "(".$ordered_menu->name." x ".$ordered_menu->quantity.")";
                        }
                        else{
                            $order_menu .= "/(".$ordered_menu->name." x ".$ordered_menu->quantity.")";

                        }
                        $loop_count += 1; 
                    }      
                    return $order_menu;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $user['currency']=$this->currency;
        $order_data = $order_data->get();
        // dd($order_data);
        return view('restaurent.customerOrder')->with(['data'=>$user,'order_data'=>$order_data]);
    }
}
