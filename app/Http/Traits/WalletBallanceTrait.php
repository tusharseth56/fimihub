<?php

namespace App\Http\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
//user import section
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Response;
use Session;
use App\Model\qbeez_wallet;


trait WalletBallanceTrait {

    public function checkWalletBalance($user_data)
    {
        $userid = $user_data->id;
        $user = new User();
        $user_data = $user->userByIdData($userid);
    
        $wallet_data=array();
        $wallet_data['user_id']=$user_data->id;
        $wallet_data['user_type']=$user_data->user_type;
        $wallet_data['wallet_type']=1;
        $qbeez_wallet = new qbeez_wallet();
        $qbeez_wallets = $qbeez_wallet->qbzWalletData($wallet_data['user_id']);
        
        if($qbeez_wallet == NULL)
        {
            $qbeez_wallet = new qbeez_wallet();
            $qbeez_wallets = $qbeez_wallet->makeQbzWallet($wallet_data);
            
        }
        
        $wallet_data = ($qbeez_wallet->qbzWalletData($wallet_data['user_id']));
        
        return $wallet_data;
    }

}
