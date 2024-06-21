<?php

namespace App\Http\Requests;

use App\Models\ZoomMeeting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreZoomMeetingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('zoom_meeting_create');
    }

    public function rules()
    {
        return [
            'course_id' => [
                'required',
                'integer',
            ],
            'headers' => [
                'string',
                'nullable',
            ],
            'topic' => [
                'required',
                'string',
                'nullable', 'min:3', 'max:255'
            ],
            //            'start_time' => [
            //                'required',
            //            ],
            //            'end_time' => [
            //                'required',
            //            ],
            'start_time' => [
                'required',
                // 'before:end_date'
            ],
            // 'end_time'   => [
            //     'required',
            //     'after:start_date'
            // ],
            'duration' => [
                'required',
                'integer',

            ],
        ];
    }
}
