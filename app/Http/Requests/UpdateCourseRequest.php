<?php

namespace App\Http\Requests;

use App\Models\Course;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCourseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('course_edit');
    }

    public function rules()
    {
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
            'lat' => 'nullable',
            'long' => 'nullable',
            "instructor_id" => 'nullable|array',
            "instructor_id" => 'nullable|exists:instructors,id',
            'name_en' => [
                'string',
                'nullable',
            ],
            'name_ar' => [
                'string',
                'nullable',
            ],
            'description_en' => [
                'string',
                'nullable',
            ],
            'description_ar' => [
                'string',
                'nullable',
            ],
            'image_en' => [
                'nullable',
            ],
            'image_ar' => [
                'nullable',
            ],
            'banner_en' => [
                'nullable',
            ],
            'banner_ar' => [
                'nullable',
            ],
            'video' => [
                'nullable',
            ],
            'start_date' => [
                'nullable',
            ],
            'end_date'   => [
                'nullable',
            ],
        ];
    }
}
