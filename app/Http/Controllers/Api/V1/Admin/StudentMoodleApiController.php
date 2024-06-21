<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreStudentMoodleRequest;
use App\Http\Requests\UpdateStudentMoodleRequest;
use App\Http\Resources\Admin\StudentMoodleResource;
use App\Models\StudentMoodle;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentMoodleApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('student_moodle_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudentMoodleResource(StudentMoodle::all());
    }

    public function store(StoreStudentMoodleRequest $request)
    {
        $studentMoodle = StudentMoodle::create($request->all());

        if ($request->input('image', false)) {
            $studentMoodle->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new StudentMoodleResource($studentMoodle))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(StudentMoodle $studentMoodle)
    {
        abort_if(Gate::denies('student_moodle_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudentMoodleResource($studentMoodle);
    }

    public function update(UpdateStudentMoodleRequest $request, StudentMoodle $studentMoodle)
    {
        $studentMoodle->update($request->all());

        if ($request->input('image', false)) {
            if (!$studentMoodle->image || $request->input('image') !== $studentMoodle->image->file_name) {
                if ($studentMoodle->image) {
                    $studentMoodle->image->delete();
                }
                $studentMoodle->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($studentMoodle->image) {
            $studentMoodle->image->delete();
        }

        return (new StudentMoodleResource($studentMoodle))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(StudentMoodle $studentMoodle)
    {
        abort_if(Gate::denies('student_moodle_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentMoodle->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
