<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
//custom import
use Illuminate\Support\Facades\DB;
use App\Model\cart;
use App\Model\cart_submenu;
use App\Model\restaurent_detail;
use App\Model\user_address;
use App\User;

class order extends Model
{
    public function makeOrder($data)
    {
        $count=DB::table('orders')->max('id');
        $unique_id=10000000001+$count;
        $data['order_id']='FF'.$unique_id;
        unset($data['_token']);
        $query_data = DB::table('orders')->insertGetId($data);
        return $query_data;
    }

    public function getOrder($orderId = false)
    {
        $query = $this->where(function($query) {
            $query->orWhere('orders.order_status', 6)->orWhere('orders.order_status', 5);
        })->select('orders.*');
        if($orderId) {
            $query = $query->where('orders.id', $orderId);
        } else {
            $query = $query->leftjoin('order_events as oe',function($query){
                $query->on('orders.id', '=', 'oe.order_id')
                ->where('oe.user_type', 1);
            })
            ->whereNull('oe.order_id');
        }
        return $query->orderBy('created_at', 'ASC')->groupBy('orders.id');
    }

    public function cart()
    {
        return $this->belongsTo(cart::class, 'cart_id');
    }

    public function restaurentDetails()
    {
        return $this->belongsTo(restaurent_detail::class, 'restaurent_id');
    }

    public function userAddress()
    {
        return $this->belongsTo(user_address::class, 'address_id');
    }

    public function restroAddress()
    {
        return $this->belongsTo(user_address::class, 'restaurent_id');
    }
}
