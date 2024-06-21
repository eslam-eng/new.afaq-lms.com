<?php

namespace App\Http\Requests;

use App\Models\Instructor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyInstructorRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('instructor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:instructors,id',
        ];
    }
}
