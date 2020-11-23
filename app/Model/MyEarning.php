<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Auth;
class MyEarning extends Model
{
    /**
        * The attributes that are mass assignable.
        *
        * @var array
        */
    protected $fillable = [
        'user_id',
        'order_id',
        'ride_price',
        'cash_price',
        'is_active',
    ];

    public function updateEarning($data, $orderId = false) {
        $id = Auth::id();
        $earning = $this->where('order_id', $orderId)->where('user_id', $id)->first();
        if(empty($earning)) {
            $earning = $this->create($data);
        } else {
            unset($data['order_id']);
            unset($data['user_id']);
            $earning = $earning->update($data);
        }

        return $earning;
    }

    public function getMyEarning($userId, $earningId = false) {
        $query = $this->where('user_id', $userId)->where('is_active', 1);
        if($earningId) {
            $query = $query->where('id', $earningId);
        }
        return $query;
    }
}
