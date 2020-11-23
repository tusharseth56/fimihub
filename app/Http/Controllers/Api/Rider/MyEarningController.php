<?php

namespace App\Http\Controllers\Api\Rider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\MyEarning;
use Auth;

class MyEarningController extends Controller
{
    public function __construct(MyEarning $myEarning)
    {
        $this->myEarning = $myEarning;
    }

    public function getMyEarning($orderId = false) {
        $userId = Auth::id();
        if($orderId) {
            $response = $this->myEarning->getMyEarning($userId, $orderId)->first();
        } else {
            $response = $this->myEarning->getMyEarning($userId)->get();
        }


        return response()->json(['data' => $response, 'message' => 'success', 'status' => true], $this->successStatus);
    }
}
