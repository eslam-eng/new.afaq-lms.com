<?php

namespace App\Http\Requests;

use App\Models\UserNotification;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserNotificationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_notification_create');
    }

    public function rules()
    {
        return [
            'parent' => [
                'string',
                'nullable',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'type' => [
                'string',
                'nullable',
            ],
            'title_en' => [
                'string',
                'nullable',
            ],
            'title_ar' => [
                'string',
                'nullable',
            ],
            'data' => [
                'string',
                'nullable',
            ],
            'fcm_token' => [
                'string',
                'nullable',
            ],
        ];
    }
}
