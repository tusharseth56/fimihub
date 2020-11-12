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
        ->join('menu_categories as mc', 'mc.id', '=', 'menu_list.menu_category_id')
        ->where('menu_list.visibility', 0)
        ->where('menu_list.restaurent_id', $data)
        ->select('menu_list.*','mc.name as cat_name','mc.discount as cat_discount')
        ->orderBy('name');
        
        return $menu_list;
    
    }

    public function menuCategory($data)
    {
        $menu_list=DB::table('menu_list')
        ->join('menu_categories as mc', 'mc.id', '=', 'menu_list.menu_category_id')
        ->distinct('menu_list.menu_category_id')
        ->where('menu_list.visibility', 0)
        ->where('menu_list.restaurent_id', $data)
        ->select('mc.id as cat_id','mc.name as cat_name','mc.discount as cat_discount')
        ->orderBy('cat_name')
        ->get();
        
        return $menu_list;
    
    }

    public function menuList($data)
    {
        $menu_list=DB::table('menu_list')
        ->join('menu_categories as mc', 'mc.id', '=', 'menu_list.menu_category_id')
        ->where('menu_list.visibility', 0)
        ->where('menu_list.restaurent_id', $data)
        ->select('menu_list.*','mc.name as cat_name','mc.discount as cat_discount')
        ->orderBy('cat_name')
        ->get();
        
        return $menu_list;
    
    }

    public function menuListById($data)
    {
        $menu_list=DB::table('menu_list')
        ->join('menu_categories as mc', 'mc.id', '=', 'menu_list.menu_category_id')
        ->where('menu_list.visibility', 0)
        ->where('menu_list.id', $data)
        ->select('menu_list.*','mc.name as cat_name','mc.discount as cat_discount')
        ->orderBy('cat_name')
        ->first();
        
        return $menu_list;
    
    }
}
