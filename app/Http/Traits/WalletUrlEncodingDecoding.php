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
use App\Model\qbeez_wallet;


trait WalletUrlEncodingDecoding {

    public function QbzUrlEncoding($encode_data)
    {
        
        $string = $encode_data['plain_text']; //Plain Text
        $key=$encode_data['key'];

        $result = '';
        for($i=0; $i<strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $char = chr(ord($char)+ord($keychar));
            $result.=$char;
        }

    
        return base64_encode($result);

    }
    public function QbzUrlDecoding($decode_data)
    {
        
        $string = $decode_data['cipher_text']; //Cipher Text
        $key=$decode_data['key'];

        $result = '';
        
        $string = base64_decode($string);

        for($i=0; $i<strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $char = chr(ord($char)-ord($keychar));
            $result.=$char;
        }
        return $result;
        
    }
}