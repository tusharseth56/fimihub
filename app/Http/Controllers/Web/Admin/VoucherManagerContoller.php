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
use App\Model\user_profile;
use App\Model\qbeez_wallet;
use App\Model\voucher;
use Response;
use Session;
use DataTables;

class VoucherManagerContoller extends Controller
{
    public function VocherListDetails(Request $request)
    {
        $user = Auth::user();
        $voucher = new voucher;
        
        $Voucher_data = $voucher->voucherPaginateData();
        if ($request->ajax()) {
            return Datatables::of($Voucher_data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="userDetails?id='.base64_encode($row->id).'" class="btn btn-outline-dark btn-sm btn-round waves-effect waves-light m-0">Details</a> 
                        <a href="?id='.base64_encode($row->id).'" class="btn btn-outline-danger btn-sm btn-round waves-effect waves-light m-0">Block</a>';
                    return $btn;
                })
                ->addColumn('created_at', function($row){
                    
                    return date('d F Y', strtotime($row->created_at));
                })
                ->addColumn('status', function($row){
                    
                    if($row->status == 0 ){
                        $stat="<span class='label label-success'>Valid</span>";
                        
                    }else{
                        $stat='<span class="label label-success">Expired</span>';

                    }
                    return $stat;
                })
                ->addColumn('amount', function($row){
                    
                    return $this->currency.' '.number_format((float)$row->amount, 2, '.', '');
                })
                ->rawColumns(['action'])
                ->make(true);
            
        }
        $user['currency']=$this->currency;
        $Voucher_data = $Voucher_data->get();
        
        return view('admin.voucherList')->with(['data'=>$user,'Voucher_data'=>$Voucher_data]);
        
    }

}
