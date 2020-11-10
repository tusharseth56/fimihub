<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
//custom import
use Illuminate\Support\Facades\DB;

class menu_list extends Model
{

    public function makeMenu($data)
    {
        $count=DB::table('menu_list')->max('listing_order');
        $unique_id=$count+1;
        $data['listing_order']=$unique_id;
        $data['updated_at'] = now();
        $data['created_at'] = now();
            unset($data['_token']);
        $query_data = DB::table('menu_list')->insertGetId($data);
        return $query_data;
    }

    public function menuPaginationData($data)
    {
        $menu_list=DB::table('menu_list')
        ->where('visibility', 0)
        ->where('restaurent_id', $data);
        
    
        return $menu_list;
    
    }
}
