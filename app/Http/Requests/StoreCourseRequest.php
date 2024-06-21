<?php

namespace App\Http\Requests;

use App\Models\Course;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCourseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('course_create');
    }

    public function rules()
    {
        // return [
        //     'category_id' => [
        //         'required',
        //         'numeric',
        //     ],
        //     'name_en' => [
        //         'string',
        //         'required',
        //     ],
        //     'name_ar' => [
        //         'string',
        //         'required',
        //     ],
        //     'accreditation' => [
        //         'required',
        //     ],
        //     'accreditation_number'         => [
        //         'nullable',
        //         'required_if:accreditation,1',
        //          'numeric', 'min:0'],
        //     'member_price' => [
        //         'nullable',
        //         'numeric',

        //     ],
        //     'non_member_price' => [
        //         'nullable',
        //         'numeric',

        //     ],
        //     'description_en' => [
        //         'required',
        //     ],
        //     'description_ar' => [
        //         'required',
        //     ],
        //     'image' => [
        //         'required',
        //     ],
        //     'start_date' => [
        //         'required',
        //         'before:end_date', 'after:today'
        //     ],
        //     'end_date'   => [
        //         'required',
        //         'after:start_date'
        //     ],
        //     'image_title_en' => [
        //         'string',
        //         'nullable',
        //     ],
        //     'image_title_ar' => [
        //         'string',

        //         'required',
        //     ],
        //     'introduction_to_course_en' => [
        //         'nullable',
        //     ],
        //     'introduction_to_course_ar' => [
        //         'nullable',
        //     ],
        //     'certificate_price' => [
        //         'nullable',
        //         'numeric',
        //     ],
        //     'start_register_date' => [
        //         'required', 'before:end_register_date',
        //     ],
        //     'early_register_date' => [
        //         'required', 'before:end_register_date',
        //     ],
        //     'end_register_date' => [
        //         'required', 'after:start_register_date',
        //         'before:end_date'
        //     ],
        //     'training_type' => [
        //         'required',
        //     ],

        //     'lecture_hours' => [
        //         'required',
        //         'integer',
        //         'min:-2147483648',
        //         'max:2147483647',
        //     ],
        //     'seating_number' => [
        //         'required',
        //         'numeric',

        //     ],
        // ];

        return [
            "course_track_id" => "nullable|exists:lookups,id",
            "course_collaborations" => 'nullable|array',
            "course_collaborations.*" => 'nullable|exists:lookups,id',
            "course_sponsors" => 'nullable|array',
            "course_sponsors" => 'nullable|exists:lookups,id',
            "course_classification_id" => 'nullable|exists:lookups,id',
            "course_sub_classifications" => 'nullable|array',
            "course_sub_classifications.*" => 'nullable|exists:lookups,id',
            "course_availability_id" => 'nullable|exists:lookups,slug',
            "course_accreditation_id" => 'nullable|exists:lookups,slug',
            "certificate_number" => "nullable|string|max:191",
            "credit_hours" => "nullable|numeric",
            "course_place_id" => 'nullable|exists:lookups,slug',
            "country_id" => "nullable|exists:countries,id",
            "city_id" => "nullable|exists:countries,id",
            // 'lat' => 'nullable|regex:^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$',
            // 'long' => 'nullable|regex:^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$',
            "instructor_id" => 'nullable|array',
            "instructor_id" => 'nullable|exists:instructors,id'
        ];
    }
}
