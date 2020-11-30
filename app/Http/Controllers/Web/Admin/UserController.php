<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userListDetails(Request $request)
    {
        $user = Auth::user();
        
        $menu_categories = new menu_categories;
        $cat_data = $menu_categories->restaurentCategoryPaginationData();
        if ($request->ajax()) {
            return Datatables::of($cat_data)
                ->addIndexColumn()
                // ->addColumn('action', function($row){
                //     $btn = ' 
                //         <a href="?id='.base64_encode($row->id).'" class="btn btn-outline-danger btn-sm btn-round waves-effect waves-light m-0">Delete</a>';
                //     return $btn;
                // })
                ->addColumn('created_at', function($row){
                    
                    return date('d F Y', strtotime($row->created_at));
                })
                ->rawColumns(['action'])
                ->make(true);
                
        }
        $user['currency']=$this->currency;
        $cat_data = $cat_data->get();
        return view('admin.menuCategory')->with(['data'=>$user,'cat_data'=>$cat_data]);
        
    }
}
