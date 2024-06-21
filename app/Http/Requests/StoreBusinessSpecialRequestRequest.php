<?php

namespace App\Http\Requests;

use App\Models\BusinessSpecialRequest;
use Gate;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class StoreBusinessSpecialRequestRequest extends FormRequest
{
//    public function authorize()
//    {
//        return Gate::allows('business_special_request_create');
//    }

    public function rules()
    {
        $now = date('Y-m-d', strtotime(now()));
        return [
            'event_type_id' => [
                'required',
                'integer',
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
                'required',
            ],
            'job_title' => [
                'string',
                'required',
            ],
            'phone_number' => [
//                'string',
                'required',
            ],
            'email_address' => [
                'required',
            ],
            'accept_terms' => [
                'nullable',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'event_type_id.required' =>  trans('cruds.businessSpecialRequest.fields.event_type') ,
            'number_of_attendees.required' => trans('cruds.businessSpecialRequest.fields.number_of_attendees'),
            'event_starting_date.required' => trans('cruds.businessSpecialRequest.fields.event_starting_date'),
            'details.required' => trans('cruds.businessSpecialRequest.fields.details'),
            'full_name.required' => trans('cruds.businessSpecialRequest.fields.full_name'),
            'phone_number.required' => trans('cruds.businessSpecialRequest.fields.phone_number'),
            'email_address.required' => trans('cruds.businessSpecialRequest.fields.email_address'),
        ];
    }
}
