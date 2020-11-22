<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
//custom import
use Illuminate\Support\Facades\DB;

class order extends Model
{
    public function makeOrder($data)
    {
        $count=DB::table('orders')->max('id');
        $unique_id=10000000001+$count;
        $data['order_id']='FF'.$unique_id;
        $data['updated_at'] = now();
        $data['created_at'] = now();
        unset($data['_token']);
        $query_data = DB::table('orders')->insertGetId($data);
        return $query_data;
    }

    public function getOrderData($order_id)
    {
        try {
            $order_data=DB::table('orders')
                ->where('visibility', 0)
                ->where('id', $order_id)
                ->first();
            
            return $order_data;
        }
        catch (Exception $e) {
            dd($e);
        }
    }

    public function allUserOrderPastData($user_id)
    {
        try {
            $order_data=DB::table('orders')
                ->join('restaurent_details as rd', 'rd.id', '=', 'orders.restaurent_id')
                ->where('orders.visibility', 0)
                ->whereIn('orders.order_status', [1,2,4,8,9,10])
                ->where('orders.user_id', $user_id)
                ->select('orders.*','rd.name as resto_name','rd.address as resto_address','rd.picture as resto_picture')
                ->orderBy('orders.created_at' ,'DESC')
                ->paginate(3);

            return $order_data;
        }
        catch (Exception $e) {
            dd($e);
        }
    }

    public function allUserCurrentPastData($user_id)
    {
        try {
            $order_data=DB::table('orders')
                ->join('restaurent_details as rd', 'rd.id', '=', 'orders.restaurent_id')
                ->where('orders.visibility', 0)
                ->whereIn('orders.order_status', [3,5,6,7])
                ->where('orders.user_id', $user_id)
                ->select('orders.*','rd.name as resto_name','rd.address as resto_address','rd.picture as resto_picture')
                ->orderBy('orders.created_at' ,'DESC')
                ->get();

            return $order_data;
        }
        catch (Exception $e) {
            dd($e);
        }
    }
}
