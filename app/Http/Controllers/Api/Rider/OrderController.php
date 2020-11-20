<?php

namespace App\Http\Controllers\Api\Rider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\NotificationTrait;
use App\Model\Notification;
use App\Model\order;
use App\User;
use Auth;

class OrderController extends Controller
{
    use NotificationTrait;

    public function __construct(order $order) {
        $this->order = $order;
    }

    public function testingNotification()
    {
        $sender_data = Auth::user();
        $push_notification_sender=array();
        $push_notification_sender['device_token'] = $sender_data->device_token;
        $push_notification_sender['title'] = 'Testing notification';
        $push_notification_sender['notification']='Testing notification body';

        $notification_sender=array();
        $notification_sender['user_id'] = $sender_data->id;
        $notification_sender['txn_id'] = 'TESTNOTIFICATION123';
        $notification_sender['title'] = 'Testing notification';
        $notification_sender['notification']='Testing notification body';
        $notification = new notification();
        $notification_id = $notification->makeNotifiaction($notification_sender);

        $push_notification_sender_result=$this->pushNotification($push_notification_sender);
        return response()->json(['message'=> 'Testing notification','status' =>true ], $this->successStatus);
    }

    public function getOrders(Request $request, int $orderId = 0)
    {
        if ($orderId) {
            $order = $this->order->getOrder($orderId)
            ->with('restroAddress','userAddress.userDetails','cart','restaurentDetails','cart.cartItems', 'cart.cartItems.menuItems')
            ->first();
        } else {

            $order = $this->order->getOrder($orderId)
            ->with('restroAddress','userAddress.userDetails')
            // to do
            // ->with(array('restroAddress' => function($query){
            //     $query->select('id', 'address', 'flat_no', 'landmark', 'longitude', 'longitude');
            // }))
            ->paginate(10);
        }
       
        return response()->json(['data' => $order, 'message' => 'Success', 'status' => true], $this->successStatus);
    }
}
