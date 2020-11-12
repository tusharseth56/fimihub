<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
//custom import
use Illuminate\Support\Facades\DB;

class cart extends Model
{
    public function makeCart($data)
    {
        $data['updated_at'] = now();
        $data['created_at'] = now();
            unset($data['_token']);
        $query_data = DB::table('carts')->insertGetId($data);
        return $query_data;
    }

    public function checkCartAvaibility($data)
    {
        try {
            $carts=DB::table('carts')
                ->where('visibility', 0)
                ->where('user_id', $data)
                ->first();
            
            return $carts;
        }
        catch (Exception $e) {
            dd($e);
        }
    }

    public function deleteCart($data)
    {
        $data['updated_at'] = now();
            
        $query_data = DB::table('carts')
                    ->where('user_id', $data)
                    ->update('visibility',2);
        $query_type="update";
    }
}
