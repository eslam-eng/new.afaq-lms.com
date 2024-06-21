<?php

namespace App\Http\Requests;

use App\Models\NotificationCampain;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateNotificationCampainRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('notification_campain_edit');
    }

    public function rules()
    {
        return [
            'title_en' => [
                'string',
                'nullable',
            ],
            'title_ar' => [
                'string',
                'nullable',
            ],
            'send_at' => [
              //  'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
