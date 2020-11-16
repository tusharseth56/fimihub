<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
//custom import
use Illuminate\Support\Facades\DB;

class cart_submenu extends Model
{

    public function makeCartSubMenu($data)
    {
        
        $value=DB::table('cart_submenus')
                ->where('menu_id', $data['menu_id'])
                ->where('user_id', $data['user_id'])
                ->where('visibility', 0);

        if($value->count() == 0)
        {
            
            $data['quantity']=1;
            $data['updated_at'] = now();
            $data['created_at'] = now();
            unset($data['_token']);
            $query_data = DB::table('cart_submenus')->insert($data);
            $query_type="insert";
            
        }
        else
        {
            $values = $value->first();
            $quantity =  $values->quantity;
            $quantity += 1;
            $data['quantity']= $quantity;
            $data['updated_at'] = now();
            unset($data['_token']);
            $query_data = DB::table('cart_submenus')
                        ->where('menu_id', $data['menu_id'])
                        ->where('user_id', $data['user_id'])
                        ->update($data);
        }
        
        return $query_data;
    }
}
