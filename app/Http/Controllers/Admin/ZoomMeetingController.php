<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CalculateCourseCompletion;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyZoomMeetingRequest;
use App\Http\Requests\StoreZoomMeetingRequest;
use App\Http\Requests\UpdateZoomMeetingRequest;
use App\Models\Course;
use App\Models\ZoomMeeting;
use App\Traits\ZoomMeetingTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ZoomMeetingController extends Controller
{
    use MediaUploadingTrait;
    use ZoomMeetingTrait;
    use CalculateCourseCompletion;

    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;


    public function index()
    {
        abort_if(Gate::denies('zoom_meeting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $zoomMeetings = ZoomMeeting::with(['course'])->orderBy('id', 'desc')->get();

        return view('admin.zoomMeetings.index', compact('zoomMeetings'));
    }

    public function create()
    {
        abort_if(Gate::denies('zoom_meeting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::pluck('name_' . app()->getLocale() . ' as name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.zoomMeetings.create', compact('courses'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $this->create_metting($request->all());

            if ($data) {
                $data['section_id'] = $request->section_id ?? null;
                $data['lecture_id'] = $request->lecture_id ?? null;

                $zoomMeeting = ZoomMeeting::create($data);

                try {
                    $this->invite($zoomMeeting->meeting_id, $zoomMeeting->meeting_type, $zoomMeeting);
                } catch (\Throwable $th) {
                    //throw $th;
                }

                if ($media = $request->input('ck-media', false)) {
                    Media::whereIn('id', $media)->update(['model_id' => $zoomMeeting->id]);
                }

                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return redirect()->route('admin.zoom-meetings.index');
    }

    public function edit(ZoomMeeting $zoomMeeting)
    {
        abort_if(Gate::denies('zoom_meeting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::pluck('name_' . app()->getLocale() . ' as name', 'id');

        $zoomMeeting->load('course');

        return view('admin.zoomMeetings.edit', compact('courses', 'zoomMeeting'));
    }

    public function update(Request $request, $id)
    {
        $zoomMeeting = ZoomMeeting::find($id);
        try {
            $data = $this->update_meeting($zoomMeeting->meeting_id, $request->all());
        } catch (\Throwable $th) {
            //throw $th;
        }

        $zoomMeeting->update($request->all());

        return redirect()->route('admin.zoom-meetings.index');
    }

    public function show(ZoomMeeting $zoomMeeting)
    {
        abort_if(Gate::denies('zoom_meeting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $zoomMeeting->load('course');

        try {
            $meeting = $this->get($zoomMeeting->meeting_id, $zoomMeeting->meeting_type);
        } catch (\Throwable $th) {
            //throw $th;
        }

        return view('admin.zoomMeetings.show', compact('zoomMeeting'));
    }

    public function destroy(ZoomMeeting $zoomMeeting)
    {
        abort_if(Gate::denies('zoom_meeting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            $this->delete($zoomMeeting->meeting_id, $zoomMeeting->meeting_type);
        } catch (\Throwable $th) {
            //throw $th;
        }

        $zoomMeeting->delete();

        return back()->with('message', __('global.delete_account_success'));;
    }

    public function reports($meeting_id)
    {
        abort_if(Gate::denies('zoom_meeting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $zoomMeeting = ZoomMeeting::with('reports')->findOrFail($meeting_id);

	 try {
         $report_status = $this->reports_meeting($zoomMeeting->meeting_id, $zoomMeeting->meeting_type);
            if (!$zoomMeeting->report_status) {
                // Add User Score precentage to User Course

                $zoomMeeting->update(['report_status' => $report_status]);
            }

            $this->updateCourseCompletion($zoomMeeting->course_id, null);
        } catch (\Throwable $th) {
             dd($th);
        }


        $zoomMeeting->load('reports');

        return view('admin.zoomMeetings.show', compact('zoomMeeting'));
    }


    public function massDestroy(MassDestroyZoomMeetingRequest $request)
    {
        ZoomMeeting::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('zoom_meeting_create') && Gate::denies('zoom_meeting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ZoomMeeting();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }


    public function reportsWithoutRedirect($meeting_id)
    {
        $zoomMeeting = ZoomMeeting::with('reports')->findOrFail($meeting_id);

        try {
            if (!$zoomMeeting->report_status) {
                $report_status = $this->reports_meeting($zoomMeeting->meeting_id, $zoomMeeting->meeting_type);

                // Add User Score precentage to User Course

                $zoomMeeting->update(['report_status' => $report_status]);
            }

            $this->updateCourseCompletion($zoomMeeting->course_id, null);
        } catch (\Throwable $th) {
        }

        return true;
    }
}
