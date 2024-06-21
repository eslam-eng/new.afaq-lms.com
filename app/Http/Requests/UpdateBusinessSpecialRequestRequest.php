<?php

namespace App\Http\Requests;

use App\Models\BusinessSpecialRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBusinessSpecialRequestRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('business_special_request_edit');
    }

    public function rules()
    {
        $now = date('Y-m-d', strtotime(now()));
        return [
            'event_type_id' => [
                'required',
               // 'integer',
            ],
            'number_of_attendees' => [
                'string',
                'required',
            ],
            'event_starting_date' => [
                'required',
                'after:'.$now
                // 'date_format:' . config('panel.date_format'),
            ],
            'details' => [
                'required',
            ],
            'full_name' => [
                'string',
                'required',
            ],
            'employer' => [
                'string',
                'nullable',
            ],
            'job_title' => [
                'string',
                'nullable',
            ],
            'phone_number' => [
              //  'string',
                'required',
            ],
            'email_address' => [
                'required','email'
            ],
            'accept_terms' => [
                'nullable',
            ],
        ];
    }
}
