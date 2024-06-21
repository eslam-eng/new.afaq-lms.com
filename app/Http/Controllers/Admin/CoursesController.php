<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCourseRequest;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\AccreditationSponsor;
use App\Models\AttendanceDesign;
use App\Models\Certificat;
use App\Models\Country;
use App\Models\Course;
use App\Models\CourseAccreditationSponsor;
use App\Models\CourseCategory;
use App\Models\CourseCertificate;
use App\Models\CourseSubSpecialty;
use App\Models\Enroll;
use App\Models\Instructor;
use App\Models\Specialty;
use App\Models\StudentMoodle;
use App\Models\SubSpecialty;
use App\Models\CourseTargetGroup;
use App\Models\CoursePrice;
use App\Models\CourseSection;
use App\Models\ExamsTitle;
use App\Models\Lookup;
use App\Models\Lookupable;
use App\Models\UserCertificate;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Notification;

class CoursesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('course_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::with(['category', 'instructor', 'media']);
        if (request('category_id')) {
            $courses = $courses->where('category_id', request('category_id'));
        }
        if (request('specialty_id')) {
            $courses = $courses->whereHas('course_target', function ($q) {
                $q->where('specialty_id', request('specialty_id'));
            });
        }
        if (request('sub_specialty_id')) {
            $courses = $courses->whereHas('course_sub_specialty', function ($q) {
                $q->where('sub_specialty_id', request('sub_specialty_id'));
            });
        }
        $courses = $courses->orderBy('id', 'desc')->get(); //->paginate(10);

        $courseCategories = CourseCategory::get();
        $specialties = Specialty::get();
        $subSpecialties = SubSpecialty::get();

    // dd($specialties);

        return view('admin.courses.index', compact('courses', 'courseCategories', 'specialties', 'subSpecialties'));
    }

    public function create()
    {
        abort_if(Gate::denies('course_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // Get Lookups related with course
        $lookups = Lookup::whereHas('type', function ($lookup_type) {
            $lookup_type->whereIn('slug', [
                'course_places',
                'course_tracks',
                'course_classifications',
                'course_availabilities',
                'course_collaborations',
                'course_sponsors',
                'course_accreditations',
                'course_organizers'
            ]);
        })->get();

        // Get target countries
        $countries = Country::whereIn('country_code', ['SA', 'EG'])->with('cities')->get();
        $certificates = Certificat::select('id','name_en','name_ar')->latest()->get();
        $attendance_designs = AttendanceDesign::select('id','name_en','name_ar')->latest()->get();
        $target_groups = Specialty::pluck('name_' . app()->getLocale() . ' as name', 'id');
        $categories = CourseCategory::pluck('name_' . app()->getLocale() . ' as name', 'id', 'moodle_id');

        $instructors = Instructor::where('status' , 1)->get();
        return view('admin.courses.create', compact(
            'lookups',
            'countries',
            'instructors',
            'target_groups',
            'categories',
            'certificates',
            'attendance_designs'
        ));
    }

    public function store(StoreCourseRequest $request)
    {


        try {
            DB::beginTransaction();
            $data = $request->all();

            $data['course_availability_id'] = isset($data['course_availability_id']) ? Lookup::where('slug', $data['course_availability_id'])->first()->id : null;
            $data['course_accreditation_id'] = isset($data['course_accreditation_id']) ? Lookup::where('slug', $data['course_accreditation_id'])->first()->id : null;
            $data['course_place_id'] = isset($data['course_place_id']) ? Lookup::where('slug', $data['course_place_id'])->first()->id : null;

            $course = Course::create($data);

            if (isset($data['course_collaborations'])) {
                foreach ($data['course_collaborations'] as $course_collaboration) {
                    $course->collaborations()->save(Lookup::find($course_collaboration), [
                        'type' => 'course_collaborations'
                    ]);
                }
            }
            if (isset($data['course_organizers'])) {
                foreach ($data['course_organizers'] as $course_organizer) {
                    $course->organizers()->save(Lookup::find($course_organizer), [
                        'type' => 'course_organizers'
                    ]);
                }
            }

            if (isset($data['course_sponsors'])) {
                foreach ($data['course_sponsors'] as $course_sponsor) {
                    $course->sponsors()->save(Lookup::find($course_sponsor), [
                        'type' => 'course_sponsors'
                    ]);
                }
            }

            if (isset($data['course_sub_classifications'])) {
                foreach ($data['course_sub_classifications'] as $course_sub_classification) {
                    $course->subClassifications()->save(Lookup::find($course_sub_classification), [
                        'type' => 'course_sub_classifications'
                    ]);
                }
            }
            if ($request->file('image_en', false)) {
                $course->addMedia($request->file('image_en'))->toMediaCollection('course_image_en_' . $course->id);
            }
            if ($request->file('image_ar', false)) {
                $course->addMedia($request->file('image_ar'))->toMediaCollection('course_image_ar_' . $course->id);
            }

            if ($request->file('banner_en', false)) {
                $course->addMedia($request->file('banner_en'))->toMediaCollection('course_banner_en_' . $course->id);
            }

            if ($request->file('banner_ar', false)) {
                $course->addMedia($request->file('banner_ar'))->toMediaCollection('course_banner_ar_' . $course->id);
            }

            if ($request->file('video', false)) {
                $course->addMedia($request->file('video'))->toMediaCollection('course_video_' . $course->id);
            }

            $course->course_instructor()->sync($request->instructor_id ?? []);
            $course->course_sub_specialty()->sync($request->course_sub_specialty_id ?? []);
            $course->course_target_group()->sync($request->target_group_id ?? []);
            //target_group_id[]

            if (!empty($request->attendance_design_id) && (isset($request->attendance_design_id[0]) && !is_null($request->attendance_design_id[0]))) {
                $course->course_attendes_many()->sync($request->attendance_design_id ?? []);
            }

            if ($request->course_accreditation_sponsor) {
                foreach ($request->course_accreditation_sponsor as $item) {
                    $course_accreditation_sponsor[] = ['course_id' => $course->id, 'accreditation_sponsor_id' => $item, 'type' => 'Accredited'];
                }
                CourseAccreditationSponsor::insert($course_accreditation_sponsor);
                // $course->course_accreditation_sponsor()->sync($course_accreditation_sponsor);
            }

            if ($request->cooperate_accreditation_sponsor) {
                foreach ($request->cooperate_accreditation_sponsor as $item) {
                    $cooperate_accreditation_sponsor[] = ['course_id' => $course->id, 'accreditation_sponsor_id' => $item, 'type' => 'Cooperated'];
                }
                CourseAccreditationSponsor::insert($cooperate_accreditation_sponsor);
                // $course->course_accreditation_sponsor()->sync($cooperate_accreditation_sponsor);
            }

            if ($request->hosting_cooperate_accreditation_sponsor) {
                foreach ($request->hosting_cooperate_accreditation_sponsor as $item) {
                    $hosting_cooperate_accreditation_sponsor[] = ['course_id' => $course->id, 'accreditation_sponsor_id' => $item, 'type' => 'Hosted'];
                }
                CourseAccreditationSponsor::insert($hosting_cooperate_accreditation_sponsor);
                // $course->course_accreditation_sponsor()->sync($hosting_cooperate_accreditation_sponsor);
            }

            //            if ($course) {
            //                $data = add_course_to_moodel('core_course_create_courses', [
            //                    'shortname'  => $course->name_ar ?? null,
            //                    'categoryid' => $course->category_id ?? 2,
            //                    'fullname'   => $course->name_ar ?? null,
            //                    'summary'    => $course->introduction_to_course_ar ?? null,
            //                    'startdate'  => strtotime($course->start_date) ?? null,
            //                    'enddate'    => strtotime($course->end_date) ?? null,
            //                ]);
            //
            //                if ($data && isset($data[0]['id'])) {
            //                    $course->update(['moodle' => $data[0]['id']]);
            //                }
            //            }
            DB::commit();
            //code...
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        if ($request->ajax()) {
            return response()->json($course, 200);
        } else {
            return redirect()->route('admin.courses.index');
        }
    }

    public function edit(Course $course)
    {
        abort_if(Gate::denies('course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = CourseCategory::pluck('name_' . app()->getLocale() . ' as name', 'id', 'moodle_id');

        // $instructors = Instructor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $course_sub_specialties = $course->course_sub_specialty()->pluck('sub_specialty_id')->toArray();
        // $accreditation_sponsor = AccreditationSponsor::pluck('name_' . app()->getLocale() . ' as name', 'id');
        $target_groups = Specialty::pluck('name_' . app()->getLocale() . ' as name', 'id');
        $certificates = Certificat::select('id','name_en','name_ar')->latest()->get();
        $attendance_designs = AttendanceDesign::select('id','name_en','name_ar')->latest()->get();

        // $course->load('category', 'instructor', 'course_sub_specialty', 'course_accreditation_sponsor', 'course_target_group', 'certificates');
        $course->load('category', 'course_instructor', 'collaborations','organizers', 'sponsors', 'subClassifications', 'certificates','attend_designs');

        $course_target_group_selected_array = $course->course_target_group->pluck('pivot.specialty_id')->toArray();
        // $course_sub_specialty_selected_array = $course->course_sub_specialty->pluck('pivot.sub_specialty_id')->toArray();
        // $course_accreditations_selected_array = $course->course_accreditations->pluck('accreditation_sponsor_id')->toArray();
        // $course_Cooperated_accreditations_selected_array = $course->course_Cooperated_accreditations->pluck('accreditation_sponsor_id')->toArray();
        // $course_Hosted_accreditations_selected_array = $course->course_Hosted_accreditations->pluck('accreditation_sponsor_id')->toArray();

        $selected_course_collaborations = $course->collaborations->pluck('pivot.lookup_id')->toArray();
        $selected_course_organizers = $course->organizers->pluck('pivot.lookup_id')->toArray();

        $selected_course_sponsors = $course->sponsors->pluck('pivot.lookup_id')->toArray();
        $selected_course_sub_classifications = $course->subClassifications->pluck('pivot.lookup_id')->toArray();
        $course_certificates_selected_array = $course->certificates->pluck('certificate_id')->toArray();
        $course_attendes_selected_array = $course->attend_designs->pluck('attendance_design_id')->toArray();

        $selected_instructors = $course->course_instructor->pluck('pivot.instructor_id')->toArray();

        // dd($selected_instructors);
        // Get Lookups related with course
        $lookups = Lookup::whereHas('type', function ($lookup_type) {
            $lookup_type->whereIn('slug', [
                'course_places',
                'course_tracks',
                'course_classifications',
                'course_availabilities',
                'course_collaborations',
                'course_sponsors',
                'course_accreditations',
                'course_organizers'

            ]);
        })->where('status', 1)->get();

        $reservation_course = Enroll::reservation_number($course->id);

        // Get target countries
        $countries = Country::whereIn('country_code', ['SA', 'EG'])->with('cities')->get();

        $reservation_course = Enroll::reservation_number($course->id);
        $instructors = Instructor::where('status',1)->get();

        return view('admin.courses.edit', compact(
            'categories',

            'course',
            'course_sub_specialties',
            'target_groups',
            // 'accreditation_sponsor',
            // 'course_sub_specialty_selected_array',
            'selected_instructors',
            'selected_course_collaborations',
            'selected_course_organizers',
            'selected_course_sponsors',
            'selected_course_sub_classifications',
            'course_target_group_selected_array',
            // 'course_accreditations_selected_array',
            // 'course_Cooperated_accreditations_selected_array',
            // 'course_Hosted_accreditations_selected_array',
            'certificates',
            'attendance_designs',
            'course_certificates_selected_array',
            'course_attendes_selected_array',
            'lookups',
            'countries',
            'instructors',
            'reservation_course'
        ));
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $data['course_availability_id'] = isset($data['course_availability_id']) ? Lookup::where('slug', $data['course_availability_id'])->first()->id : $course->course_availability_id;
            $data['course_accreditation_id'] = isset($data['course_accreditation_id']) ? Lookup::where('slug', $data['course_accreditation_id'])->first()->id : $course->course_accreditation_id;
            $data['course_place_id'] = isset($data['course_place_id']) ? Lookup::where('slug', $data['course_place_id'])->first()->id : $course->course_place_id;
            $data['show_in_homepage'] = isset($data['show_in_homepage']) ? 'on' : ((isset($data['step']) && $data['step'] == 1) ? 'off' : ($course->show_in_homepage ? 'on' : 'off'));
            if (isset($data['step']) && $data['step'] == 5) {
                $data['has_general_price'] = isset($data['has_general_price']) ? 'on' : 'off';
            }
            $data['has_exclusive_mobile'] = isset($data['has_exclusive_mobile']) ? 'on' : 'off';
            if (isset($data['step']) && $data['step'] == 4) {
                $data['has_special_policy'] = isset($data['has_special_policy']) ? 1 : 0;
            }

            $course->update($data);

            if (isset($data['course_collaborations'])) {
                Lookupable::where('lookupable_id', $course->id)->where('type', 'course_collaborations')->forceDelete();
                foreach ($data['course_collaborations'] as $course_collaboration) {
                    $course->collaborations()->save(Lookup::find($course_collaboration), [
                        'type' => 'course_collaborations'
                    ]);
                }
            } else {
                if (isset($data['step']) && $data['step'] == 1) {
                    Lookupable::where('lookupable_id', $course->id)->where('type', 'course_collaborations')->forceDelete();
                }
            }

            if (isset($data['course_organizers'])) {
                Lookupable::where('lookupable_id', $course->id)->where('type', 'course_organizers')->forceDelete();
                foreach ($data['course_organizers'] as $course_organizer) {
                    $course->organizers()->save(Lookup::find($course_organizer), [
                        'type' => 'course_organizers'
                    ]);
                }
            } else {
                if (isset($data['step']) && $data['step'] == 1) {
                    Lookupable::where('lookupable_id', $course->id)->where('type', 'course_organizers')->forceDelete();
                }
            }

            if (isset($data['course_sponsors'])) {
                Lookupable::where('lookupable_id', $course->id)->where('type', 'course_sponsors')->forceDelete();
                foreach ($data['course_sponsors'] as $course_sponsor) {
                    $course->sponsors()->save(Lookup::find($course_sponsor), [
                        'type' => 'course_sponsors'
                    ]);
                }
            } else {
                if (isset($data['step']) && $data['step'] == 1) {
                    Lookupable::where('lookupable_id', $course->id)->where('type', 'course_sponsors')->forceDelete();
                }
            }

            if (isset($data['course_sub_classifications'])) {
                Lookupable::whereIn('lookup_id', $data['course_sub_classifications'])->forceDelete();
                foreach ($data['course_sub_classifications'] as $course_sub_classification) {
                    $course->subClassifications()->save(Lookup::find($course_sub_classification), [
                        'type' => 'course_sub_classifications'
                    ]);
                }
            }

            if ($request->file('image_en', false)) {
                if (!$course->image_en || $request->file('image_en') !== $course->image_en->file_name) {
                    if ($course->image_en) {
                        $course->image_en->delete();
                    }
                    $course->addMedia($request->file('image_en'))->toMediaCollection('course_image_en_' . $course->id);
                }
            }

            if ($request->file('image_ar', false)) {
                if (!$course->image_ar || $request->file('image_ar') !== $course->image_ar->file_name) {
                    if ($course->image_ar) {
                        $course->image_ar->delete();
                    }
                    $course->addMedia($request->file('image_ar'))->toMediaCollection('course_image_ar_' . $course->id);
                }
            }

            if ($request->file('banner_en', false)) {
                if (!$course->banner_en || $request->file('banner_en') !== $course->banner_en->file_name) {
                    if ($course->banner_en) {
                        $course->banner_en->delete();
                    }
                    $course->addMedia($request->file('banner_en'))->toMediaCollection('course_banner_en_' . $course->id);
                }
            }

            if ($request->file('banner_ar', false)) {
                if (!$course->banner_ar || $request->file('banner_ar') !== $course->banner_ar->file_name) {
                    if ($course->banner_ar) {
                        $course->banner_ar->delete();
                    }
                    $course->addMedia($request->file('banner_ar'))->toMediaCollection('course_banner_ar_' . $course->id);
                }
            }

            if ($request->file('video', false)) {
                if (!$course->video || $request->file('video') !== $course->video->file_name) {
                    if ($course->video) {
                        $course->video->delete();
                    }
                    $course->addMedia($request->file('video'))->toMediaCollection('course_video_' . $course->id);
                }
            }
            // elseif ($course->image) {
            //     $course->image->delete();
            // }
            if (!empty($request->instructor_id)) {
                $course->course_instructor()->sync($request->instructor_id ?? []);
            }
            if (!empty($request->course_sub_specialty_id)) {
                $course->course_sub_specialty()->sync($request->course_sub_specialty_id ?? []);
            }
            if (!empty($request->target_group_id)) {
                $course->course_target_group()->sync($request->target_group_id ?? []);
            }
            if (!empty($request->certificate_id)) {
                $course->course_certificates_many()->sync($request->certificate_id ?? []);
                UserCertificate::where('course_id',$course->id)->update([
                    'certificate_id' => $request->certificate_id[0]
                ]);
            }
            if (!empty($request->attendance_design_id) && isset($request->attendance_design_id[0]) ) {
                $course->course_attendes_many()->sync($request->attendance_design_id ?? []);
            }
            if (!empty($request->target_group_id)) {
                CoursePrice::where('course_id', $course->id)
                    ->whereNotIn('specialty_id', $request->target_group_id)
                    ->delete();

                    // $users = \App\Models\User::whereIn('specialty_id',$request->target_group_id)->get();

                    // Notification::send($users, new \App\Notifications\RealTimeNotification([
                    //     // 'user_id' => $user->id,
                    //     'message' => 'new course added',
                    //     'title_en' => 'new course added',
                    //     'title_ar' => 'new course added ',
                    //     'message_en' => 'new course added',
                    //     'message_ar' => 'new course added ',
                    //     'type' => 'course',
                    //     'parent_id' => null,
                    // ]));


            }

            if ($request->course_accreditation_sponsor) {
                CourseAccreditationSponsor::where(['course_id' => $course->id, 'type' => 'Accredited'])->delete();
                foreach ($request->course_accreditation_sponsor as $item) {
                    $course_accreditation_sponsor[] = ['course_id' => $course->id, 'accreditation_sponsor_id' => $item, 'type' => 'Accredited'];
                }
                CourseAccreditationSponsor::insert($course_accreditation_sponsor);
            }

            if ($request->cooperate_accreditation_sponsor) {
                CourseAccreditationSponsor::where(['course_id' => $course->id, 'type' => 'Cooperated'])->delete();
                foreach ($request->cooperate_accreditation_sponsor as $item) {
                    $cooperate_accreditation_sponsor[] = ['course_id' => $course->id, 'accreditation_sponsor_id' => $item, 'type' => 'Cooperated'];
                }
                CourseAccreditationSponsor::insert($cooperate_accreditation_sponsor);
            }

            if ($request->hosting_cooperate_accreditation_sponsor) {
                CourseAccreditationSponsor::where(['course_id' => $course->id, 'type' => 'Hosted'])->delete();
                foreach ($request->hosting_cooperate_accreditation_sponsor as $item) {
                    $hosting_cooperate_accreditation_sponsor[] = ['course_id' => $course->id, 'accreditation_sponsor_id' => $item, 'type' => 'Hosted'];
                }
                CourseAccreditationSponsor::insert($hosting_cooperate_accreditation_sponsor);
            }
            //code...
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        if ($request->ajax()) {
            return response()->json($course, 200);
        } else {
            return redirect()->route('admin.courses.index');
        }
    }

    public function show(Course $course)
    {
        abort_if(Gate::denies('course_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course->load('category', 'instructor', 'course_target_group');

        return view('admin.courses.show', compact('course'));
    }

    public function destroy(Course $course)
    {
        abort_if(Gate::denies('course_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course->delete();

        return back()->with('message', __('global.delete_account_success'));
    }

    public function massDestroy(MassDestroyCourseRequest $request)
    {
        Course::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('course_create') && Gate::denies('course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Course();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function ChangePublish(Request $request)
    {
        $input = $request->all();
        $course = Course::find($request->course_id);

        $course->status = $request->status;
        $course->save();
        return response()->json(['success' => 'Status change successfully.']);
    }

    public function content(Request $request)
    {

        $course_id = $request->course_id;
        $sections = CourseSection::where('course_id', $course_id)->with(['lectures' => function ($lectures) {
            $lectures->orderBy('order', 'asc');
        }])->get();
        $exam_titles = ExamsTitle::pluck('name_' . app()->getLocale() . ' as name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.courses.courseContent.course-content', compact('course_id', 'sections', 'exam_titles'));
    }
    /**
     *
     */

    public function courseView()
    {
        $courses = Course::with(['media'])
            ->where('show_in_homepage', 1)
            ->orderBy('order', 'asc')->get();
        return view('admin.courses.reorder', compact('courses'));
    }
    public function sortCourses(Request $request)
    {
        foreach ($request->order as $key => $order) {
            $courses = Course::find($order['id'])->update(['order' => $order['order']]);
        }
        return response('Update Successfully.', 200);
    }
}
