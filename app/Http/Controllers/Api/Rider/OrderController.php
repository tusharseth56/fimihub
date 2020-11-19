<?php

namespace App\Http\Controllers\Api\Rider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\NotificationTrait;
use App\Model\Notification;
use App\User;
use Auth;

class OrderController extends Controller
{
    use NotificationTrait;

    public function TestingNotification()
    {
        $sender_data = Auth::user();
        // dd($sender_data);
        // $reciever_data = $user->userByIdData($pay_data['reciever_id']);

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
        return response()->json(['message'=> 'Testing notification','status' =>true ], $this->failureStatus);
    }
}
