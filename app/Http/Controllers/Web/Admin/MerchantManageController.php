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
use App\Http\Traits\WalletBallanceTrait;
use App\Model\qbeez_wallet_transaction;
use App\Model\merchant_detail;
use App\Model\category_record;
use App\Model\merchant_category_record;
use App\Model\user_profile;
use App\Model\qbeez_wallet;
use Response;
use Session;
use DataTables;

class MerchantManageController extends Controller
{
    public function MerchantListDetails(Request $request)
    {
        $user = Auth::user();
        $user_instance = new User;
        
        $user_data = $user_instance->allUserPaginateList(2);
        
        if ($request->ajax()) {
            return Datatables::of($user_data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="merchantDetails?id='.base64_encode($row->id).'" class="btn btn-outline-dark btn-sm btn-round waves-effect waves-light m-0">Details</a> 
                        <a href="?id='.base64_encode($row->id).'" class="btn btn-outline-danger btn-sm btn-round waves-effect waves-light m-0">Block</a>';
                    return $btn;
                })
                ->addColumn('created_at', function($row){
                    
                    return date('d F Y', strtotime($row->created_at));
                })
                ->rawColumns(['action'])
                ->make(true);
            
        }
        $user['currency']=$this->currency;
        $user_data = $user_data->get();
        
        return view('admin.merchantList')->with(['data'=>$user,'user_data'=>$user_data]);
        
    }

    public function MerchantDetails(Request $request)
    {
        $user = Auth::user();
        $user_id =  base64_decode($request->input('id'));
        $user_instance = new User;
        $user_data = $user_instance->userByIdData($user_id);
        $merchant_detail = new merchant_detail();
        $merchant_data = $merchant_detail->merchantData($user_id);
        $merchant_category_data['user_id']=$user_id;
            $merchant_category_data['type']=1;
            if($merchant_category_data['type']==1)
            {
                $merchant_category_record = new merchant_category_record;
                $merchant_category_record = ($merchant_category_record->merchantCategoryData($merchant_category_data));
                if($merchant_category_record !=NULL){
                    $merchant_category_record = json_encode($merchant_category_record);
                    $merchant_data->business_category=json_decode($merchant_category_record)->category_id;
                    $category_record = new category_record;
                    $category_record = json_encode($category_record->categoryDataById($merchant_data->business_category));
                    $merchant_data->business_category=json_decode($category_record)->name;
                }
            }
            $merchant_category_data['type']=2;
            if($merchant_category_data['type']==2)
            {
                $merchant_category_record = new merchant_category_record;
                $merchant_category_record = ($merchant_category_record->merchantCategoryData($merchant_category_data));
                if($merchant_category_record !=NULL){
                    $merchant_category_record = json_encode($merchant_category_record);
                    $merchant_data->business_sub_category=json_decode($merchant_category_record)->category_id;
                    $category_record = new category_record;
                    $category_record = json_encode($category_record->categoryDataById($merchant_data->business_sub_category));
                    $merchant_data->business_sub_category=json_decode($category_record)->name;
                }
            }
            //  $merchant_data->country=($merchant_data)->country;;
        $qbeez_wallet = new qbeez_wallet();
        $qbeez_wallets = $qbeez_wallet->qbzWalletData($user_id);
        $user['currency']=$this->currency;
        //dd($merchant_data);
        return view('admin.merchantProfile')->with(['data' => $user,
                                                'user_data' => $user_data,
                                                'merchant_data' => $merchant_data,
                                                'wallet_data' => $qbeez_wallets]);
        
    }

    public function MerchantUpdateDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|nullable',
            'email' => 'email|nullable',
            'city_state' => 'string|nullable',
            'country' => 'string|nullable',
            'store_info' => 'string|nullable',
            'business_name' => 'string|nullable',
            
        ]);
        if(!$validator->fails()){
            $user = Auth::user();
            $data = $request->toarray();
            $id = $data['id'];
            
            $user_instance = new User;
            $user_data = $user_instance->userByIdData($data['id']);
            $user_update_data=array();
            $user_update_data['id']=$id;
            if($request->has('password'))
            {
                unset($data['password']);
            }
            if($request->has('email')){
                if($data['email'] == $user_data->email){
                    $ab=1;
                }else{
                    $user_update_data['email']=$data['email'];
                    $user_update_data['email_verified_at']=NULL;
                }
                
            }

            if($request->has('mobile')){
                if($data['mobile'] == $user_data->email){
                    $ab=1;
                }else{
                    $user_update_data['mobile']=$data['mobile'];
                    $user_update_data['mobile_verified_at']=NULL;
                }
                
            }
            if($request->has('name')){
                $user_update_data['name']=$data['name'];
            }
            $user = auth()->user()->UpdateLogin($user_update_data);
            $user_data = auth()->user()->userByIdData($id);
            unset($user_data->password);

            $profile_data=array();
            $profile_data['user_id']=$data['id'];

            if($request->has('city_state')){
                $profile_data['city_state']=$data['city_state'];
            }
            if($request->has('country')){
                $profile_data['country']=$data['country'];
            }
            if($request->has('store_info')){
                $profile_data['store_info']=$data['store_info'];
            }
            if($request->has('business_name')){
                $profile_data['business_name']=$data['business_name'];
            }
        

            $merchant_detail = new merchant_detail();
            $profile_data_update = $merchant_detail->insertUpdateMerchantData($profile_data);
            $profile_data = $merchant_detail->merchantData($profile_data['user_id']);

            Session::flash('message', 'Merchant Profile Updated !'); 
            return redirect()->back();

        }else{
            return redirect()->back()->withInput()->withErrors($validator);  
        }
    
    }

    public function MerchantWalletListDetails(Request $request)
    {
        $user = Auth::user();
        $qbeez_wallet = new qbeez_wallet;
        
        $wallet_data = $qbeez_wallet->qbzWalletPaginationData(2);
        if ($request->ajax()) {
            return Datatables::of($wallet_data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="userDetails?id='.base64_encode($row->id).'" class="btn btn-outline-dark btn-sm btn-round waves-effect waves-light m-0">Transactions</a> 
                        <a href="?id='.base64_encode($row->id).'" class="btn btn-outline-danger btn-sm btn-round waves-effect waves-light m-0">Delete</a>';
                    return $btn;
                })
                ->addColumn('created_at', function($row){
                    
                    return date('d F Y', strtotime($row->created_at));
                })
                ->addColumn('open_balance', function($row){
                    
                    return $this->currency.' '.number_format((float)$row->open_balance, 2, '.', '');
                })
                ->rawColumns(['action'])
                ->make(true);
                
        }
        $user['currency']=$this->currency;
        $wallet_data = $wallet_data->get();
        // dd($wallet_data);
        
        return view('admin.merchantWalletList')->with(['data'=>$user,'wallet_data'=>$wallet_data]);
        
    }



}
