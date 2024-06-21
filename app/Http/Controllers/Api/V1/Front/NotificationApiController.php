<?php

namespace App\Http\Controllers\Api\V1\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\NotificationResource;
use App\Models\UserNotification;
use App\Models\UserToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationApiController extends Controller
{
    public function storeFcmToken(Request $request)
    {
        if (request()->header('fcmtoken')) {
            $fcm_token = request()->header('fcmtoken');
        } elseif (request('fcm_token')) {
            $fcm_token = request('fcm_token');
        } else {
            return $this->toJson(null, 400, 'Fcm Device token required', false);
        }

        $fcm = UserToken::where(['fcm_token' => $fcm_token])->first();

        if ($fcm && request('user_id')) {
            $fcm->update(['fcm_token' => $request->fcm_token,  'user_id' => request('user_id')]);
        } else {
            $fcm = UserToken::firstOrCreate(['fcm_token' => $fcm_token]);
        }

        return $this->toJson($fcm, 200, 'Token successfully stored.', true);
    }

    public function welcomeNotification()
    {
        $noti = SendNotification([
            'title_en' => __('notification.welcome_title', [], 'en'),
            'message_en' => __('notification.welcome_message', [], 'en'),
            'title_ar' => __('notification.welcome_title', [], 'ar'),
            'message_ar' => __('notification.welcome_message', [], 'ar')
        ]);
        if ($noti) {
            return $this->toJson($noti);
        }
        return $this->toJson(null, 400, 'not sent', false);
    }

    public function notifications()
    {
        if (request()->header('fcmtoken')) {
            $notifications = UserNotification::where('fcm_token', request()->header('fcmtoken'))->orderBy('id','desc')->get();
        } elseif (request('fcm_token')) {
            $notifications = UserNotification::where('fcm_token', request('fcm_token'))->orderBy('id','desc')->get();
        } elseif (request('user_id')) {
            $notifications = UserNotification::where('user_id', request('user_id'))->orderBy('id','desc')->get();
        } else {
            $notifications = null;
        }

        return $this->toJson([
            'unread_count' => $notifications ? $notifications->where('read', 0)->count() : 0,
            'notifications' => $notifications ? NotificationResource::collection($notifications) : null
        ]);
    }

    public function notification($notification_id)
    {
        if (request()->header('fcmtoken')) {
            $notification = UserNotification::where('id', $notification_id)->where('fcm_token', request()->header('fcmtoken'))->first();
        } elseif (request('fcm_token')) {
            $notification = UserNotification::where('id', $notification_id)->where('fcm_token', request('fcm_token'))->first();
        } elseif (request('user_id')) {
            $notification = UserNotification::where('id', $notification_id)->where('user_id', request('user_id'))->first();
        } else {
            $notification = null;
        }

        if ($notification) {
            $updated = $notification->update(['read' => 1]);
            return $this->toJson($updated ? true : false);
        }

        return $this->toJson(null, 400, 'there is no notification with this id.', false);
    }
}
