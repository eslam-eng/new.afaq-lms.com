<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\Course;
use App\Models\CourseSection;
use App\Models\CourseSectionLecture;
use App\Models\CourseSectionLectureNote;
use App\Models\ExamsTitle;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CourseSectionLecturesController extends Controller
{

    use MediaUploadingTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        switch ($request->lecture_type) {
            case 'quize':
                $startTime = Carbon::parse(strtotime($request->start_at));
                $endTime = Carbon::parse(strtotime($request->end_at));

                $duration = $endTime->diffInMinutes($startTime);

                $lecture = CourseSectionLecture::create([
                    'title_en' => $request->title_en,
                    'title_ar' => $request->title_ar,
                    'accessing' => $request->accessing,
                    'course_id' => $request->course_id,
                    'course_section_id' => $request->section_id,
                    'duration' => $duration,
                    'type' => 'quize',
                ]);
                $request->request->add(['lecture_id' => $lecture->id]);

                $quizeController =  new CourseQuizeController;
                $quize = $quizeController->store($request);

                break;
            case 'zoom':
                $lecture = CourseSectionLecture::create([
                    'title_en' => $request->topic,
                    'title_ar' => $request->topic,
                    'accessing' => $request->accessing,
                    'course_id' => $request->course_id,
                    'course_section_id' => $request->section_id,
                    'duration' => $request->duration,
                    'type' => 'zoom',
                ]);

                $request->request->add(['lecture_id' => $lecture->id]);

                $quizeController =  new ZoomMeetingController;
                $quize = $quizeController->store($request);
                break;
            case 'file':
                $request->request->add(['course_section_id' => $request->section_id]);
                $request->request->add(['type' => 'file']);
                $lecture = CourseSectionLecture::create($request->all());

                if ($request->input('attachment', false)) {
                    $lecture->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('lecture_attachment');
                }
                break;
            case 'video':
                $data = $request->all();
                if ($request->attachment) {
                    $data['file'] = $request->attachment;
                }
                $data['course_section_id'] = $request->section_id;
                $data['type'] = 'video';
                $lecture = CourseSectionLecture::create($data);

                // if ($request->input('attachment', false)) {
                //     $lecture->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('lecture_attachment');
                // }
                break;
            case 'photo':
                $request->request->add(['course_section_id' => $request->section_id]);
                $request->request->add(['type' => 'photo']);
                $lecture = CourseSectionLecture::create($request->all());

                if ($request->input('attachment', false)) {
                    $lecture->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('lecture_attachment');
                }
                break;
            case 'attendance_design':
                $request->request->add(['course_section_id' => $request->section_id]);
                $request->request->add(['type' => 'attendance_design']);
                $lecture = CourseSectionLecture::create($request->all());

                //                if ($request->input('attachment', false)) {
                //                    $lecture->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('lecture_attachment');
                //                }
                break;
            default:
                # code...
                break;
        }
        return view('admin.courses.courseContent.cards.lecture-created-card', compact('lecture'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lecture = CourseSectionLecture::find($id);

        if ($lecture) {
            switch ($lecture->type) {
                case 'quize':
                    $exam_titles = ExamsTitle::pluck('name_' . app()->getLocale() . ' as name', 'id')->prepend(trans('global.pleaseSelect'), '');
                    $courseQuize = $lecture->quize;
                    return view('admin.courses.courseContent.forms.update-quize-form', compact('courseQuize', 'lecture', 'exam_titles'))->render();
                    break;
                case 'zoom':
                    $zoomMeeting = $lecture->zoom;
                    return view('admin.courses.courseContent.forms.update-zoom-form', compact('lecture', 'zoomMeeting'))->render();
                    break;
                default:
                    return view('admin.courses.courseContent.forms.update-lecture-form', compact('lecture'))->render();

                    break;
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lecture = CourseSectionLecture::find($id);
        switch ($request->lecture_type) {
            case 'quize':
                $startTime = Carbon::parse(strtotime($request->start_at));
                $endTime = Carbon::parse(strtotime($request->end_at));

                $duration = $endTime->diffInMinutes($startTime);

                $lecture->update([
                    'title_en' => $request->title_en,
                    'title_ar' => $request->title_ar,
                    'accessing' => $request->accessing,
                    'course_id' => $lecture->course_id,
                    'course_section_id' => $lecture->course_section_id,
                    'duration' => $duration,
                    'type' => 'quize',
                ]);

                $request->request->add(['lecture_id' => $lecture->id]);

                $quizeController =  new CourseQuizeController;
                $quize = $quizeController->update($request, $lecture->quize->id);

                break;
            case 'zoom':
                if ($lecture) {
                    $lecture->update([
                        'title_en' => $request->topic,
                        'title_ar' => $request->topic,
                        'accessing' => $request->accessing,
                        'course_id' => $lecture->course_id,
                        'course_section_id' => $lecture->course_section_id,
                        'duration' => $request->duration,
                        'type' => 'zoom',
                    ]);
                }

                $request->request->add(['lecture_id' => $lecture->id]);

                $quizeController =  new ZoomMeetingController;
                $quize = $quizeController->update($request, $lecture->zoom->id);

                break;
            case 'file':
                if ($lecture) {
                    $lecture->update($request->all());
                }

                if ($request->input('attachment', false)) {
                    $lecture->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('lecture_attachment');
                }
                break;
            case 'video':
                if ($lecture) {
                    $data = $request->all();
                    if ($request->attachment) {
                        $data['file'] = $request->attachment;
                    }
                    $lecture->update($data);
                }

                // if ($request->input('attachment', false)) {
                //     $lecture->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('lecture_attachment');
                // }
                break;
            case 'image':
                if ($lecture) {
                    $lecture->update($request->all());
                }

                if ($request->input('attachment', false)) {
                    $lecture->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('lecture_attachment');
                }
                break;
            case 'attendance_design':
                if ($lecture) {
                    $lecture->update($request->all());
                }

                //                if ($request->input('attachment', false)) {
                //                    $lecture->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('lecture_attachment');
                //                }
                break;
            default:
                # code...
                break;
        }
        return view('admin.courses.courseContent.cards.lecture-card', compact('lecture'))->render();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lecture = CourseSectionLecture::find($id);

        if ($lecture) {
            switch ($lecture->type) {
                case 'quize':
                    $lecture->quize->delete();
                    break;
                case 'zoom':
                    $lecture->zoom->delete();
                    break;
                default:
                    # code...
                    break;
            }

            $lecture->delete();
        }

        return true;
    }

    public function sorting(Request $request)
    {
        $input = $request->all();

        if (!empty($input['lectures'])) {
            foreach ($input['lectures'] as $key => $value) {
                $key = $key + 1;
                CourseSectionLecture::where('course_section_id', $input['section_id'])->where('id', $value)
                    ->update([
                        'order' => $key
                    ]);
            }
        }
        return response()->json(['status' => 'success']);
    }

    public function dependsOn(Request $request)
    {

        if ($request->isMethod('post')) {
            $lecture = CourseSectionLecture::find($request->id);

            if ($lecture) {
                $lecture->update([
                    'depends_on_id' => $request->depends_on_id
                ]);
            }

            return response()->json(['status' => 'success']);
        } elseif ($request->isMethod('get')) {
            $lecture = CourseSectionLecture::find($request->lecture_id);
            $section_lectures = CourseSectionLecture::where('course_section_id', $request->section_id)->where('id', '!=', $request->lecture_id)->get();
            return view('admin.courses.courseContent.forms.depends-on', compact('lecture', 'section_lectures'))->render();
        }
    }

    public function notes(Request $request)
    {
        $notes = CourseSectionLectureNote::where('course_section_lecture_id', $request->lecture_id)->get();
        $lecture = CourseSectionLecture::find($request->lecture_id);

        return view('admin.courses.courseContent.forms.lecture-notes', compact('notes', 'lecture'))->render();
    }

    public function notesStore(Request $request)
    {
        CourseSectionLectureNote::where('course_section_lecture_id', $request->lecture_id)->delete();

        foreach ($request->notes as $note) {
            $note['course_section_lecture_id'] = $request->course_section_lecture_id;
            $note['course_id'] = $request->course_id;
            $note['course_section_id'] = $request->course_section_id;
            CourseSectionLectureNote::create($note);
        }

        return true;
    }
}
