<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
//custom import
use Illuminate\Support\Facades\DB;

class user_address extends Model
{
    public function makeAddress($data)
    {
        $data['updated_at'] = now();
        $data['created_at'] = now();
            unset($data['_token']);
        $query_data = DB::table('user_address')->insertGetId($data);
        return $query_data;
    }

    public function getUserAddress($userid)
    {
        try {
            $user_address=DB::table('user_address')
                ->where('visibility', 0)
                ->where('user_id', $userid)
                ->get();
            
            return $user_address;
        }
        catch (Exception $e) {
            dd($e);
        }
    }
}
