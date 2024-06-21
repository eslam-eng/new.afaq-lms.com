<?php

namespace App\Http\Requests;

use App\Models\ZoomMeeting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyZoomMeetingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('zoom_meeting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:zoom_meetings,id',
        ];
    }
}
