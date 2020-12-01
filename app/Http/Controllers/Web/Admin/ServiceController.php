<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//custom import
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Response;
use Session;
use DataTables;


class ServiceController extends Controller
{
    public function serviceListDetails(Request $request)
    {
        $user = Auth::user();
        $users = new user;
        $user_list = $users->allUserPaginateList(4);
        if ($request->ajax()) {
            return Datatables::of($user_list)
                ->addIndexColumn()
                // ->addColumn('action', function($row){
                //     $btn = '<a href="userDetails?id='.base64_encode($row->id).'" class="btn btn-outline-dark btn-sm btn-round waves-effect waves-light m-0">Details</a> 
                //         <a href="?id='.base64_encode($row->id).'" class="btn btn-outline-danger btn-sm btn-round waves-effect waves-light m-0">Block</a>';
                //     return $btn;
                // })
                ->addColumn('created_at', function($row){
                    
                    return date('d F Y', strtotime($row->created_at));
                })
                ->rawColumns(['action'])
                ->make(true);
                
        }
        $user['currency']=$this->currency;
        $user_list = $user_list->get();        
        return view('admin.serviceList')->with(['data'=>$user]);
        
    }
}
