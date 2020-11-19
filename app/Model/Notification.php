<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
//custom import
use Illuminate\Support\Facades\DB;
use Exception;

class Notification extends Model
{
    public function makeNotifiaction($data)
    {
        $data['updated_at'] = now();
        $data['created_at'] = now();

        $query_data = DB::table('notifications')->insertGetId($data);


        return $query_data;
    }

    public function getAllUnReadNotification($user_id)
    {
        try
        {
            $notification_data=DB::table('notifications')
                    ->where('user_id', $user_id)
                    ->where('visibility',0)
                    ->orderBy('created_at','desc')
                    ->paginate(8);

            return $notification_data;
        }
        catch (Exception $e) {
            dd($e);
        }
    }

    public function getAllReadNotification($user_id)
    {
        try
        {
            $notification_data=DB::table('notifications')
                    ->where('user_id', $user_id)
                    ->where('visibility',1)
                    ->orderBy('created_at','desc')
                    ->paginate(8);

            return $notification_data;
        }
        catch (Exception $e) {
            dd($e);
        }
    }

    public function getNotificationById($user_id, $id)
    {
        try
        {
            $notification_data=DB::table('notifications')
                    ->where('id', $id)
                    ->where('user_id', $user_id)
                    ->orderBy('created_at','desc')
                    ->first();

            return $notification_data;
        }
        catch (Exception $e) {
            dd($e);
        }
    }
    public function getAllNotifications($user_id)
    {
        try
        {
            $notification_data=DB::table('notifications')
                    ->where('user_id', $user_id)
                    ->orderBy('created_at','desc')
                    ->paginate(8);

            return $notification_data;
        }
        catch (Exception $e) {
            dd($e);
        }
    }

}
