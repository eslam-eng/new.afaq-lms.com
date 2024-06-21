<?php

namespace App\Http\Requests;

use App\Models\StudentMoodle;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyStudentMoodleRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('student_moodle_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:student_moodles,id',
        ];
    }
}
