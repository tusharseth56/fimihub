<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
//custom import
use Illuminate\Support\Facades\DB;

class restaurent_detail extends Model
{
    public function insertUpdateRestoData($data)
    {
        $value=DB::table('restaurent_details')->where('user_id', $data['user_id'])->get();
        if($value->count() == 0)
        {
            $count=DB::table('restaurent_details')->max('id');
            $unique_id=100001+$count;
            $data['resto_id']='FIMIRESTO'.$unique_id;
            $data['updated_at'] = now();
            $data['created_at'] = now();
            unset($data['_token']);
            $query_data = DB::table('restaurent_details')->insert($data);
            $query_type="insert";
            
        }
        else
        {
            $data['updated_at'] = now();
            unset($data['_token']);
            $query_data = DB::table('restaurent_details')
                        ->where('user_id', $data['user_id'])
                        ->update($data);
        }
        
        return $query_data;
    }

    public function getRestoData($userid)
    {
        try {
            $restaurent_details=DB::table('restaurent_details')
                ->where('visibility', 0)
                ->where('user_id', $userid)
                ->first();
            
            return $restaurent_details;
        }
        catch (Exception $e) {
            dd($e);
        }
    }

    public function getRestoDataOnId($userid)
    {
        try {
            $restaurent_details=DB::table('restaurent_details')
                ->where('visibility', 0)
                ->where('id', $userid)
                ->first();
            
            return $restaurent_details;
        }
        catch (Exception $e) {
            dd($e);
        }
    }
    public function getallRestoData()
    {
        try {
            $restaurent_details=DB::table('restaurent_details')
                ->where('visibility', 0)
                ->orderBy('name')
                ->limit(6)
                ->get();
            
            return $restaurent_details;
        }
        catch (Exception $e) {
            dd($e);
        }
    }

    public function getallRestaurant()
    {
        try {
            $restaurent_details=DB::table('restaurent_details')
                ->where('visibility', 0);
            
            return $restaurent_details;
        }
        catch (Exception $e) {
            dd($e);
        }
    }
}
