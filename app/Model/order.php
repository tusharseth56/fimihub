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
        $query = $this->where( function($query) {
            $query->orWhere('order_status', 6)->orWhere('order_status', 5);
        });
        if($orderId) {
            $query = $query->where('id', $orderId);
        }
        return $query;
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
