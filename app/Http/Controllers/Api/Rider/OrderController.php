<?php

namespace App\Http\Controllers\Api\Rider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\NotificationTrait;
use App\Model\Notification;
use App\Model\order;
use App\Model\OrderEvent;
use App\User;
use Auth, Validator;

class OrderController extends Controller
{
    use NotificationTrait;

    public function __construct(order $order, OrderEvent $orderEvent) {
        $this->order = $order;
        $this->orderEvent = $orderEvent;
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
            ->with('restroAddress','userAddress.userDetails','restaurentDetails','cart.cartItems.menuItems')
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

    public function updateEventOrderStatus(Request $request) {
        $validator = $this->validateUpdateStatus();

        if($validator->fails()) {
            $message = collect($validator->messages())->values()->first();
            return response()->json(['data' => $message[0], 'message' => 'Validation failed', 'status' => false], $this->successStatus);
        }
        $id = Auth::id();
        $orderId = $request->input('order_id');
        $orderStatus = $request->input('order_status');
        $data = array(
            'user_id' => $id,
            'order_status' => $orderStatus,
            'user_type' => 1,
            'visibility' => 0,
            'order_id' => $orderId
        );

        if($orderStatus == 6) { // // Order rejected by rider
            $data['resion_id'] = $request->input('resion_id');
            $data['order_comment'] = $request->input('order_comment');
            $response = $this->orderEvent->updateStatus($orderId, $data);

        } else if($orderStatus == 5) { // Order delivered
            $data['resion_id'] = $request->input('resion_id');
            $data['order_comment'] = $request->input('order_comment');

            $orderDetails = $this->order->getOrder($orderId)->first();
            if(!empty($orderId)) {
                // To do
                if($request->input('payment_type') == 3) {
                    $price = $orderDetails->price;
                    $collectedPrice = $request->input('price');
                    if($price >= $collectedPrice) {
                        // update rider earning
                    }
                }
            }

            $response = $this->orderEvent->updateStatus($orderId, $data);
        } else {
            $response = $this->orderEvent->updateStatus($orderId, $data);
        }

        return response()->json(['data' => $data, 'message' => 'Status updated successfully.', 'status' => true], $this->successStatus);
    }



    public function validateUpdateStatus() {
        return Validator::make(request()->all(), array(
            'order_status' => 'required|integer|in:1,2,3,4,5,6',
            'order_id' => 'required|integer',
            'resion_id' => 'nullable|required_if:order_status,6|nullable',
            'order_comment' => 'nullable|required_if:order_status,6|string',
            'payment_type' => 'nullable|required_if:order_status,5|numeric',
            'price' => 'nullable|required_if:payment_type,3|numeric',
        ));
    }
}
