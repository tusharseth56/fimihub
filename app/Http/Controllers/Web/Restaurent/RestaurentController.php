<?php

namespace App\Http\Controllers\Web\Restaurent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
//custom import
use App\Model\restaurent_detail;
use App\Model\menu_categories;
use App\Model\menu_list;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Traits\OtpGenerationTrait;
use Response;
use Session;
use File;
use DataTables;


class RestaurentController extends Controller
{
    public function accountDetails()
    {
        $user = Auth::user();
        $restaurent_detail = new restaurent_detail;
        $resto_data = $restaurent_detail->getRestoData($user->id);
        
        return view('restaurent.myDetails')->with(['data'=>$user,'resto_data'=>$resto_data]);
        
    }

    public function addRestaurentDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|nullable',
            'about' => 'string|nullable',
            'other_details' => 'string|nullable',    
            'picture' => 'mimes:png,jpg,jpeg|max:3072|nullable',    
            'official_number' => 'numeric|nullable',    
            'avg_cost' => 'numeric|nullable',    
            'avg_time' => 'string|nullable',    
            'open_time' => 'string|nullable',    
            'close_time' => 'string|nullable',    
            'address' => 'string|nullable',    
            'delivery_charge' => 'string|nullable',    
            'pincode' => 'string|nullable',    
            'resto_type' => 'in:1,2,3|nullable',    
            
        ]);
        if(!$validator->fails()){
            $user = Auth::user();
            $id = $user->id;
            $data = $request->toarray();
            $data['user_id'] =$user->id;
            $restaurent_detail = new restaurent_detail;
            if($request->hasfile('picture'))
            {
                $profile_pic = $request->file('picture');
                $input['imagename'] = 'RestaurentProfilePicture'.time().'.'.$profile_pic->getClientOriginalExtension();

                $path = public_path('uploads/'.$id.'/images');
                File::makeDirectory($path, $mode = 0777, true, true);
                                
                $destinationPath = 'uploads/'.$id.'/images'.'/';
                if($profile_pic->move($destinationPath, $input['imagename']))
                {
                    $file_url=url($destinationPath.$input['imagename']);
                    $data['picture']=$file_url;
                
                }else{
                    $error_file_not_required[]="Profile Picture Have Some Issue";
                    unset($data['picture']);
                }
                
            }
            else{
                unset($data['picture']);
            }
        
            $resto_id = $restaurent_detail->insertUpdateRestoData($data);
            Session::flash('message', 'Restaurent Data Updated !');

            return redirect()->back();

        }
        else{
        	return redirect()->back()->withInput()->withErrors($validator);  
        }
        
    }

    public function categoryDetails(Request $request)
    {
        $user = Auth::user();
        
       
        $restaurent_detail = new restaurent_detail;
        $resto_data = $restaurent_detail->getRestoData($user->id);
        $menu_categories = new menu_categories;
        $cat_data = $menu_categories->restaurentCategoryPaginationData($resto_data->id);
        if ($request->ajax()) {
            // dd($user_data);
            // date('d F Y')
            return Datatables::of($cat_data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="userDetails?id='.base64_encode($row->id).'" class="btn btn-outline-dark btn-sm btn-round waves-effect waves-light m-0">Details</a> 
                        <a href="?id='.base64_encode($row->id).'" class="btn btn-outline-danger btn-sm btn-round waves-effect waves-light m-0">Block</a>';
                    return $btn;
                })
                ->addColumn('created_at', function($row){
                    
                    return date('d F Y', strtotime($row->created_at));
                })
                ->rawColumns(['action'])
                ->make(true);
                //dd($user_data);
        }
        $user['currency']=$this->currency;
        $cat_data = $cat_data->get();
        return view('restaurent.menuCategory')->with(['data'=>$user,'cat_data'=>$cat_data]);
        
    }

    public function addCategoryProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|nullable|unique:menu_categories,name,'.auth()->user()->id.',restaurent_id',
            'about' => 'string|nullable',
            'discount' => 'numeric|nullable',       
            
        ]);
        if(!$validator->fails()){
            $user = Auth::user();
            $restaurent_detail = new restaurent_detail;
            $resto_data = $restaurent_detail->getRestoData($user->id);
            $data = $request->toarray();
            $data['restaurent_id'] =$resto_data->id;
            $menu_categories = new menu_categories;
        
            $cate_id = $menu_categories->makeMenuCategory($data);
            Session::flash('message', 'Category Added Successfully!');

            return redirect()->back();

        }
        else{
        	return redirect()->back()->withInput()->withErrors($validator);  
        }
        
    }

    public function getMenuList(Request $request)
    {
        $user = Auth::user();
        
    
        $restaurent_detail = new restaurent_detail;
        $resto_data = $restaurent_detail->getRestoData($user->id);
        $menu_categories = new menu_categories;
        $cat_data = $menu_categories->restaurentCategoryPaginationData();
        $menu_list = new menu_list;
        $menu_data = $menu_list->menuPaginationData($resto_data->id);
        if ($request->ajax()) {
            return Datatables::of($menu_data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="userDetails?id='.base64_encode($row->id).'" class="btn btn-outline-dark btn-sm btn-round waves-effect waves-light m-0">Details</a> 
                        <a href="?id='.base64_encode($row->id).'" class="btn btn-outline-danger btn-sm btn-round waves-effect waves-light m-0">Block</a>';
                    return $btn;
                })
                ->addColumn('created_at', function($row){
                    
                    return date('d F Y', strtotime($row->created_at));
                })
                ->addColumn('dish_type', function($row){
                    if($row->dish_type==1){
                        return "Non-Veg";
                    }
                    else{
                        return "Veg";
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
                //dd($user_data);
        }
        $cat_data = $cat_data->get();
        return view('restaurent.menuList')->with(['data'=>$user,'cat_data'=>$cat_data]);
        
    }

    public function menuListProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|nullable',
            'picture' => 'mimes:png,jpg,jpeg|nullable',
            'about' => 'string|nullable',
            'discount' => 'numeric|nullable',       
            'price' => 'required|numeric|not_in:0',       
            'dish_type' => 'required|in:1,2|nullable',       
            'menu_category_id' => 'required|exists:menu_categories,id|nullable',       
            
        ]);
        if(!$validator->fails()){
            $user = Auth::user();
            $id = $user->id;
            $data = $request->toarray();


            if($request->hasfile('picture'))
            {
                $profile_pic = $request->file('picture');
                $input['imagename'] = $data['name'].time().'.'.$profile_pic->getClientOriginalExtension();

                $path = public_path('uploads/'.$id.'/images');
                File::makeDirectory($path, $mode = 0777, true, true);
                                
                $destinationPath = 'uploads/'.$id.'/images'.'/';
                if($profile_pic->move($destinationPath, $input['imagename']))
                {
                    $file_url=url($destinationPath.$input['imagename']);
                    $data['picture']=$file_url;
                
                }else{
                    $error_file_not_required[]="Food Picture Have Some Issue";
                    unset($data['picture']);
                }
                
            }
            else{
                unset($data['picture']);
            }
            $restaurent_detail = new restaurent_detail;
            $resto_data = $restaurent_detail->getRestoData($user->id);
            $data['restaurent_id'] =$resto_data->id;
            $menu_list = new menu_list;

            
            $cate_id = $menu_list->makeMenu($data);
            Session::flash('message', 'Menu Added Successfully!');

            return redirect()->back();

        }
        else{
        	return redirect()->back()->withInput()->withErrors($validator);  
        }
        
    }
}
