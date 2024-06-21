<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CalculateCourseCompletion;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAttendanceDesignRequest;
use App\Http\Requests\StoreAttendanceDesignRequest;
use App\Http\Requests\UpdateAttendanceDesignRequest;
use App\Models\AttendanceDesign;
use App\Models\AttendanceDesignKey;
use App\Models\Course;
use App\Models\CourseAttendenceDesign;
use App\Models\CourseSectionLecture;
use App\Models\Enroll;
use App\Models\User;
use App\Models\UserAttendance;
use App\Models\UserAttendenceDesign;
use App\Models\UsersCourse;
use App\Notifications\AttendanceCardNotification;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class AttendanceDesignsController extends Controller
{
    use MediaUploadingTrait;
    use CalculateCourseCompletion;

    public function index()
    {
        abort_if(Gate::denies('attendance_design_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attendanceDesigns = AttendanceDesign::with(['media'])->orderBy('id', 'desc')->get();

        return view('admin.attendanceDesigns.index', compact('attendanceDesigns'));
    }

    public function create()
    {
        abort_if(Gate::denies('attendance_design_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $keys = AttendanceDesignKey::all();
        return view('admin.attendanceDesigns.create', compact('keys'));
    }

    public function store(StoreAttendanceDesignRequest $request)
    {
        $inputs = $request->all();
        $attendanceDesign = AttendanceDesign::create($inputs);

        if ($request->file('image', false)) {
            $attendanceDesign->addMedia($request->file('image'))->toMediaCollection('image');
        }

        $attendanceDesign->content = $request->cert;
        $attendanceDesign->save();

        return redirect()->route('admin.attendance-designs.index');
    }

    public function edit(AttendanceDesign $attendanceDesign)
    {
        abort_if(Gate::denies('attendance_design_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $keys = AttendanceDesignKey::all();

        $canvas_json = json_decode($attendanceDesign->content, true) ?? null;
        return view('admin.attendanceDesigns.edit', compact('attendanceDesign', 'keys', 'canvas_json'));
    }

    public function update(UpdateAttendanceDesignRequest $request, AttendanceDesign $attendanceDesign)
    {

        $attendanceDesign->update($request->all());

        if ($request->file('image', false)) {
            if (!$attendanceDesign->image || $request->file('image') !== $attendanceDesign->image->file_name) {
                if ($attendanceDesign->image) {
                    $attendanceDesign->image->delete();
                }
                $attendanceDesign->addMedia($request->file('image'))->toMediaCollection('image');
            }
        }
        $attendanceDesign->content = $request->cert;
        $attendanceDesign->save();

        return redirect()->route('admin.attendance-designs.index');
    }

    public function show(AttendanceDesign $attendanceDesign)
    {
        abort_if(Gate::denies('attendance_design_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.attendanceDesigns.show', compact('attendanceDesign'));
    }

    public function destroy(AttendanceDesign $attendanceDesign)
    {
        abort_if(Gate::denies('attendance_design_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attendanceDesign->delete();

        return back()->with('message', __('global.delete_account_success'));
    }

    public function massDestroy(MassDestroyAttendanceDesignRequest $request)
    {
        AttendanceDesign::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('attendance_design_create') && Gate::denies('attendance_design_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new AttendanceDesign();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    /**
     * Generate Attendance Designs
     */
    public function generate_attendance_designs($course_id)
    {
        $course = Course::findOrFail($course_id);
        $pass_course_users = UsersCourse::where('course_id', $course_id);


        if (request('user_id')) {
            $pass_course_users = $pass_course_users->where('user_id', request('user_id'));
            //            dd($pass_course_users);
        } else {
            $pass_course_users = $pass_course_users->where('completion_percentage', '>=', $course->success_percentage ?? 0);
        }

        $pass_course_users = $pass_course_users->get();

        $not_pass_course_users = UsersCourse::where('course_id', $course_id)
            ->where('completion_percentage', '<', $course->success_percentage ?? 0)
            ->get();

        $userdata = UsersCourse::SELECT('user_id')->where('course_id', $course_id)->pluck('user_id')->toArray();

        $enrolls = Enroll::where('course_id', $course_id)->whereIn('user_id', $userdata)->where('approved', 1)->pluck('user_id')->toArray();

        $all = UsersCourse::with('user', 'course')->where('course_id', $course_id)->whereIn('user_id', $enrolls)->get();

        $users = User::whereIn('id', $pass_course_users->pluck('user_id')->toArray())->get();

        $this->create_user_attendance_card($course_id, $pass_course_users);


        return view('admin.courses.generate_attendance_designs_data', compact('pass_course_users', 'not_pass_course_users', 'all'));
    }
    /**
     *Create Attendance Design Card From Admin
     */
    public function create_user_attendance_card($course_id, $pass_course_users = [])
    {
        $course_attendance = CourseAttendenceDesign::where('course_id', $course_id)->first();
        //        dd($course_attendance);
        $attendance_design = DB::table('attendance_designs')->where('id', $course_attendance->attendance_design_id)->first();

        foreach ($pass_course_users as $key => $course_user) {
            $user_attendance = UserAttendenceDesign::firstOrCreate(['user_id' => $course_user->user_id, 'course_id' => $course_id, 'attendance_design_id' => $attendance_design->id]);

            if (!$user_attendance->attendance_design_img) {

                $canvas_json = json_decode($attendance_design->content, true);

                try {
                    if (!$user_attendance->qrcode) {
                        $qrcode = \QrCode::format("png")->size(220)->generate((route('view.attendance_card', [
                            'user_id' => $user_attendance->user_id,
                            'course_id' => $user_attendance->course_id,
                            'attendance_design_id' => $user_attendance->attendance_design_id,

                        ])));
                        $qr_img = "data:image/png;base64, " . base64_encode($qrcode);
                        $user_attendance->qrcode = $qr_img;
                        $user_attendance->save();
                    }
                } catch (\Throwable $th) {
                    // throw $th;
                }
                if (isset($canvas_json['objects'])) {
                    foreach ($canvas_json['objects'] as $k => $value) {
                        if (isset($value['type']) && ($value['type'] == 'i-text' || $value['type'] == 'textbox')) {
                            $key = AttendanceDesignKey::where('key', $value['text'])->first();
                            try {
                                if ($key) {
                                    if ($key->type == 'App\Models\User') {
                                        $value['text'] = (string)DB::table('users')->where('id', $user_attendance->user_id)->first()->{$key->related_coulmn} ?? '';
                                    }
                                    if ($key->type == 'App\Models\Course') {
                                        $value['text'] = (string)DB::table('courses')->where('id', $user_attendance->course_id)->first()->{$key->related_coulmn} ?? '';
                                    }
                                    //                                    if ($key->type == 'App\Models\Exam') {
                                    //                                        $value['text'] = (string)DB::table('exams')->where('id', $user_certificate->exam_id)->first()->{$key->related_coulmn} ?? '';
                                    //                                    }
                                }
                            } catch (\Throwable $th) {
                                //throw $th;
                            }
                        } elseif (isset($value['type']) && $value['type'] == 'image' && $value['src'] == 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRdKgmfKEMbsxqE4WwPeUQDYeqb619rnPvUnciLyJG_WLWKw5S7t6qRHlw0AcH7PcbRnQY&usqp=CAU') {
                            $value['src'] = $user_attendance->qrcode;
                        }
                        $canvas_json['objects'][$k] = $value;
                    }
                }

                $user_attendance->update(['attendance_design_img' => $canvas_json]);

                $users = User::where('id', $user_attendance->user_id)->get();

                $data =[
                    // 'user_id' => $users->id,
                    'message' => 'Attendance Card',
                    'title_en' => 'Attendance Card',
                    'title_ar' => 'Attendance Card ',
                    'message_en' => 'Attendance Card',
                    'message_ar' => ' Attendance Card',
                    'type' => 'course',
                    'parent_id' => null,
                ];
                    try {
//                        Notification::send($users, new CertificateExportingNotification($user_certificate->course));
                        Notification::send($users, new AttendanceCardNotification($user_attendance ));

                    } catch (\Throwable $th) {
                throw $th;
                     }
            }
        }
    }
    /**
     *
     * View Card Attendance
     */

    public function viewAttendanceCard()
    {
        try {
            $user_attendance = UserAttendenceDesign::firstOrCreate(['user_id' => request('user_id'), 'course_id' => request('course_id'), 'attendance_design_id' => request('attendance_design_id'), 'lecture_id' => request('lecture_id')]);

            $attendance_design = AttendanceDesign::find(request('attendance_design_id'));

            $canvas_json = json_decode($attendance_design->content, true);


            if (!$user_attendance->qrcode) {
                $qrcode = \QrCode::format("png")->size(220)->generate((route('view.attendance_card', [
                    'user_id' => $user_attendance->user_id,
                    'course_id' => $user_attendance->course_id,
                    'attendance_design_id' => $user_attendance->attendance_design_id,
                    'lecture_id' => request('lecture_id')
                ])));
                $qr_img = "data:image/png;base64, " . base64_encode($qrcode);
                $user_attendance->qrcode = $qr_img;
                $user_attendance->save();
            }

            if (isset($canvas_json['objects'])) {
                foreach ($canvas_json['objects'] as $k => $value) {
                    if (isset($value['type']) && ($value['type'] == 'i-text' || $value['type'] == 'textbox')) {
                        $key = AttendanceDesignKey::where('key', $value['text'])->first();
                        try {
                            if ($key) {
                                if ($key->type == 'App\Models\User') {
                                    $value['text'] = (string)DB::table('users')->where('id', $user_attendance->user_id)->first()->{$key->related_coulmn} ?? '';
                                }
                                if ($key->type == 'App\Models\Course') {
                                    $value['text'] = (string)DB::table('courses')->where('id', $user_attendance->course_id)->first()->{$key->related_coulmn} ?? '';
                                }
                                //                                if ($key->type == 'App\Models\Exam') {
                                //                                    $value['text'] = (string)DB::table('exams')->where('id', $user_attendance->exam_id)->first()->{$key->related_coulmn} ?? '';
                                //                                }
                            }
                        } catch (\Throwable $th) {
                            //throw $th;
                        }
                    } elseif (isset($value['type']) && $value['type'] == 'image' && $value['src'] == 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRdKgmfKEMbsxqE4WwPeUQDYeqb619rnPvUnciLyJG_WLWKw5S7t6qRHlw0AcH7PcbRnQY&usqp=CAU') {
                        $value['src'] = $user_attendance->qrcode;
                    }
                    $canvas_json['objects'][$k] = $value;
                }
            }

            $user_attendance->update(['attendance_design_img' => $canvas_json]);
            try {
                $this->save_log(auth()->user()->id, "The user: " . auth()->user()->name . " Get " . $attendance_design->name_en . " Card.");
            } catch (\Throwable $th) {
                //throw $th;
            }

            $attend = UserAttendance::where([
                'user_id' => $user_attendance->user_id,
                'course_id' => $user_attendance->course_id,
                'attendance_design_id' => $user_attendance->attendance_design_id,
                'lecture_id'                  => request('lecture_id')
            ])->first();
            return view('frontend.view-attendance_card', compact('attendance_design', 'canvas_json', 'user_attendance', 'attend'));
        } catch (\Throwable $th) {
            // throw $th;
            return back();
        }

        // $pdf = PDF::loadHTML($attendance_design->content, [
        //     'format' => 'A4-L'
        //   ])->stream('certificate.pdf');
        // return $pdf;
    }

    public function get_attendance_design()
    {
        try {
            $user_attendance = UserAttendenceDesign::firstOrCreate([
                'user_id' => auth()->user()->id, 'course_id' => request('course_id'),
                'attendance_design_id' => request('attendance_design_id'), 'lecture_id' => request('lecture_id')
            ]);
            $attendance_design = AttendanceDesign::find(request('attendance_design_id'));

            $canvas_json = json_decode($attendance_design->content, true);


            if (!$user_attendance->qrcode) {
                $qrcode = \QrCode::format("png")->size(220)->generate((route('view.attendance_card', [
                    'user_id' => $user_attendance->user_id,
                    'course_id' => $user_attendance->course_id,
                    'attendance_design_id' => $user_attendance->attendance_design_id,
                    'lecture_id'                  => request('lecture_id')

                ])));
                $qr_img = "data:image/png;base64, " . base64_encode($qrcode);
                $user_attendance->qrcode = $qr_img;
                $user_attendance->save();
            }

            if (isset($canvas_json['objects'])) {
                foreach ($canvas_json['objects'] as $k => $value) {
                    if (isset($value['type']) && ($value['type'] == 'i-text' || $value['type'] == 'textbox')) {
                        $key = AttendanceDesignKey::where('key', $value['text'])->first();
                        try {
                            if ($key) {
                                if ($key->type == 'App\Models\User') {
                                    $value['text'] = (string)DB::table('users')->where('id', $user_attendance->user_id)->first()->{$key->related_coulmn} ?? '';
                                }
                                if ($key->type == 'App\Models\Course') {
                                    $value['text'] = (string)DB::table('courses')->where('id', $user_attendance->course_id)->first()->{$key->related_coulmn} ?? '';
                                }
                                //                                if ($key->type == 'App\Models\Exam') {
                                //                                    $value['text'] = (string)DB::table('exams')->where('id', $user_attendance->exam_id)->first()->{$key->related_coulmn} ?? '';
                                //                                }
                            }
                        } catch (\Throwable $th) {
                            //throw $th;
                        }
                    } elseif (isset($value['type']) && $value['type'] == 'image' && $value['src'] == 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRdKgmfKEMbsxqE4WwPeUQDYeqb619rnPvUnciLyJG_WLWKw5S7t6qRHlw0AcH7PcbRnQY&usqp=CAU') {
                        $value['src'] = $user_attendance->qrcode;
                    }
                    $canvas_json['objects'][$k] = $value;
                }
            }

            $user_attendance->update(['attendance_design_img' => $canvas_json]);
            try {
                $this->save_log(auth()->user()->id, "The user: " . auth()->user()->name . " Get " . $attendance_design->name_en . " Attendance Design.");
            } catch (\Throwable $th) {
                //throw $th;
            }
            $attend = UserAttendance::where([
                'user_id' => $user_attendance->user_id,
                'course_id' => $user_attendance->course_id,
                'attendance_design_id' => $user_attendance->attendance_design_id,
                'lecture_id'                  => request('lecture_id')
            ])->first();
            return view('attend_card', compact('attendance_design', 'canvas_json', 'user_attendance', 'attend'));

        }
        catch (\Throwable $th) {
            throw $th;
            //            return back();
        }

        // $pdf = PDF::loadHTML($certificate->content, [
        //     'format' => 'A4-L'
        //   ])->stream('certificate.pdf');
        // return $pdf;
    }

    public function get_attendance_img()
    {
        $attendance_design = AttendanceDesign::find(request('attendance_design_id'));
        $user_attendance = UserAttendenceDesign::firstOrCreate([
            'user_id' => request('user_id'),
            'course_id' => request('course_id'),
            'attendance_design_id' => request('attendance_design_id'),
            'lecture_id' => request('lecture_id'),
        ]);
        // $user_certificate = UserCertificate::firstOrCreate(['user_id' => request('user_id'), 'exam_id' => request('exam_id'), 'certificate_id' => request('certificate_id')]);


        return view('attend_card2', compact('attendance_design', 'user_attendance'));
    }

    /**
     * @return true
     * Save Attendance
     */
    public function save_attendance_design()
    {
        $user_attendance = UserAttendenceDesign::firstOrCreate(['user_id' => request('user_id'), 'course_id' => request('course_id'), 'attendance_design_id' => request('attendance_design_id')]);
        $user_attendance->update(['attendance_design_img' => request('attendance_design_img')]);
        return true;
    }
    /**
     *
     * Attend course
     */
    public function attend_course()
    {
        $course = Course::find(request('course_id'));
        if ($course) {
            switch ($course->attend_type) {
                case 'attend':
                    $user_attendance = UserAttendance::firstOrCreate([
                        'user_id' => request('user_id'),
                        'course_id' => request('course_id'),
                        'attendance_design_id' => request('attendance_design_id'),
                        'lecture_id' => request('lecture_id'),
                        'attend_time' => Carbon::now()->format('d-m-Y H:i:s'),
                        'percentage' => 100
                    ]);
                    break;

                default:
                    $user_attendance = UserAttendance::firstOrCreate([
                        'user_id' => request('user_id'),
                        'course_id' => request('course_id'),
                        'attendance_design_id' => request('attendance_design_id'),
                        'lecture_id' => request('lecture_id'),
                        'attend_time' => Carbon::now()->format('d-m-Y H:i:s'),
                    ]);
                    break;
            }
        } else {
            $user_attendance = UserAttendance::firstOrCreate([
                'user_id' => request('user_id'),
                'course_id' => request('course_id'),
                'attendance_design_id' => request('attendance_design_id'),
                'lecture_id' => request('lecture_id'),
                'attend_time' => Carbon::now()->format('d-m-Y H:i:s'),
            ]);
        }

        $this->updateCourseCompletion(request('course_id'), null);

        return true;
    }

    /**
     * @return true
     * Leave Course
     */
    public function leave_course()
    {
        $user_attendance = UserAttendance::find(request('id'));
        $lecture = CourseSectionLecture::find($user_attendance->lecture_id);
        $now = Carbon::now();
        $diff = $now->diffInMinutes($user_attendance->attend_time);
        $attended_time = $lecture->duration - $diff;
        if ($attended_time <= 0) {
            $percentage = 100;
        } else if ($attended_time > 0) {
            $percentage = (($lecture->duration-$attended_time) / $lecture->duration) * 100;
        }

        $user_attendance->update(['leave_time' => Carbon::now()->format('d-m-Y H:i:s'), 'percentage' => $percentage]);

        $this->updateCourseCompletion($user_attendance->course_id, null);

        return true;
    }
}
