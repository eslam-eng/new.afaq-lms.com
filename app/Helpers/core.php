<?php

use App\Models\Point;
use App\Models\PointAction;
use App\Models\PointType;
use App\Models\UserNotification;
use App\Models\UserToken;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

function getFcmTokens()
{
    if (request()->header('fcmtoken')) {
        $tokens = UserToken::where('fcm_token', request()->header('fcmtoken'))->get();
    } elseif (request('fcm_token')) {
        $tokens = UserToken::where('fcm_token', request('fcm_token'))->get();
    } elseif (request('user_id')) {
        $tokens = UserToken::where('user_id', request('user_id'))->get();
    } else {
        $tokens = null;
    }

    return $tokens;
}

function SendNotification($data, $fcmTokens = null, $campain = null,$item_id = null,$action_type = null)
{
    try {
        $fcmTokens = $fcmTokens ?? getFcmTokens();
        $title = isset($data['title_' . app()->getLocale()]) ? $data['title_' . app()->getLocale()] : 'test';
        $message = isset($data['message_' . app()->getLocale()]) ? $data['message_' . app()->getLocale()] : 'test';

        $url = 'https://fcm.googleapis.com/fcm/send';

        $serverKey = config('app.firebase_key');
        $postData = [
            "registration_ids" => $fcmTokens ? array_column($fcmTokens->toArray(), 'fcm_token') : [],
            "notification" => [
                "title" => $title,
                "body" => $message,
            ],
            "action"=>[
                "item_id" => $item_id,
                "action_type" => $action_type
            ]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        // Execute post
        $result = curl_exec($ch);

        // if ($result === FALSE) {
        //     die('Curl failed: ' . curl_error($ch));
        // }
        // Close connection
        curl_close($ch);
        // FCM response
        // dd($result);

        foreach ($fcmTokens as $key => $value) {
            if (isset($value->fcm_token)) {
                UserNotification::create([
                    'user_id' => isset($value->user_id) ? $value->user_id : null,
                    'fcm_token' => isset($value->fcm_token) ? $value->fcm_token : null,
                    'parent_id' => $campain ? $campain->id : null,
                    'type' => $campain ? 'campain' : null,
                    "title_en" => isset($data['title_en']) ? $data['title_en'] : 'test',
                    "message_en" => isset($data['message_en']) ? $data['message_en'] : 'test',
                    "title_ar" => isset($data['title_ar']) ? $data['title_ar'] : 'test',
                    "message_ar" => isset($data['message_ar']) ? $data['message_ar'] : 'test',
                    'data' => $result ?? [],
                    'status' => $result ? 1 : 0,
                    'read' => 0,
                    'item_id' => $item_id,
                    'action' => $action_type
                ]);
            }
        }

        return $result ? true : false;
    } catch (\Throwable $th) {
        throw $th;
    }
}

function WelcomeMsg()
{
    $date = date('Y-m-d h:i:s A');
    $time = (int)date('H', strtotime($date));
    $lang = app()->getLocale();
    $msgDefault = $lang == 'en' ? 'Afaq' : 'أفاق';

    if (
        config('app.welcome_msg_en')
        && config('app.welcome_msg_ar')
        && config('app.welcome_msg_start_date')
        && config('app.welcome_msg_end_date')
        && (date('Y-m-d h:i:s A', strtotime(config('app.welcome_msg_start_date'))) <= $date && $date <= date('Y-m-d h:i:s A', strtotime(config('app.welcome_msg_end_date'))))
    ) {
        $msg = config('app.welcome_msg_' . app()->getLocale(), 'please add welcome msg in evntoo configurations');
    } elseif ($time >= 13 && $time <= 18) {
        $msg = __('home.afternoon');
    } elseif ($time >= 5 && $time <= 12) {
        $msg = __('home.morning');
    } elseif (($time >= 19 && $time <= 24) || ($time >= 0 && $time <= 4)) {
        $msg = __('home.evening');
    } else {
        $msg = $msgDefault;
    }

    return $msg;
}


function get_price($price)
{
    if ($price) {
        return $price . ' ' . __('home.curruncy');
    } elseif (strval($price) != '') {
        return  '0';
    }
}

function get_image($image)
{
    if ($image) {
        return $image;
    } else {
        return  asset('afaq/logo.png');
    }
}


function upload_video_to_s3($file)
{
    // try {
    // $fileName = $file->getClientOriginalName();
    // $path = Storage::disk('s3')->put($fileName, file_get_contents($file));
    // $path = Storage::disk('s3')->url($path);

    $path = $file->store('videos', 'public');
    return $path;
    // return Storage::disk('s3')->url($path);
    // return Storage::disk('s3')->response('images/' . $file->getClientOriginalName());
    // } catch (\Throwable $th) {
    // return null;
    //throw $th;
    // }
}

function get_video_to_s3($file)
{
    try {
        return asset('storage/'.$file);
    } catch (\Throwable $th) {
        return null;
        //throw $th;
    }
}


function points($type = null)
{
    $user = auth()->user();

    if (!$user) {
        return null;
    }

    switch ($type) {
        case 'invite':
            $point_type = PointType::with('value')->where('key', $type)->first();
            if ($point_type && $point_type->value) {
                $point_type_value = ['give_point' => $point_type->value->give_point, 'get_point' => $point_type->value->get_point];
                $give_user_point = Point::where('invite_code', request('code'))->first();
                $give_points = $give_user_point->points + $point_type_value['give_point'];
                $give_user_point->update(['points' => $give_points]);

                $get_user_point = Point::where('user_id', auth()->user()->id)->first();
                $get_points = $get_user_point->points + $point_type_value['get_point'];
                $get_user_point->update(['use_code' => 1, 'used_code' => request('code'), 'points' => $get_points]);

                PointAction::create([
                    'user_id' => auth()->user()->id,
                    'from_user_id' => $give_user_point->user_id,
                    'points'  => $give_points,
                    'type' => 'invite'
                ]);

                PointAction::create([
                    'user_id' => $give_user_point->user_id,
                    'from_user_id' => null,
                    'points'  => $get_points,
                    'type' => 'invite'
                ]);
                return true;
            }
            break;


        case 'redeem':
            $get_user_point = Point::where('user_id', auth()->user()->id)->first();
            if ($get_user_point && $get_user_point->points > 0) {
                $points = $get_user_point->points;
                $money = ($points / config('app.point_to_money', 10));

                $wallet = Wallet::firstOrCreate(['user_id' => auth()->user()->id]);
                if ($money > 0 && $wallet && $wallet->update(['balance' => $wallet->balance + $money])) {
                    $get_user_point->update(['points' => 0]);

                    PointAction::create([
                        'user_id' => auth()->user()->id,
                        'points'  => $points,
                        'amount' => $money,
                        'type' => 'redeem'
                    ]);

                    return true;
                }
            }
            break;

        default:
            return null;
            break;
    }

    return null;
}
