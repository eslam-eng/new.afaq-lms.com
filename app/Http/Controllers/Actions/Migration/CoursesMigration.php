<?php

namespace App\Http\Controllers\Actions\Migration;

use App\DataLoader\Core\Loader;
use App\Http\Controllers\Actions\Migration\MigrateOldData;
use App\Models\CouponCode;
use App\Models\Course;
use App\Models\CourseQuize;
use App\Models\CourseSectionLecture;
use App\Models\ExamsTitle;
use App\Models\Lookup;
use App\Models\LookupType;
use App\Models\QuestionAnswer;
use App\Models\QuestionBank;
use App\Models\Specialty;
use App\Models\SubSpecialty;
use App\Models\User;
use App\Models\UsersCourse;
use App\Models\ZoomMeeting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CoursesMigration extends MigrateOldData
{
    public function courseMigration()
    {
        $course_mapped = [
            'startdate' => 'start_date',
            'enddate' => 'end_date',
            'start_registration_date' => 'start_register_date',
            'end_registration_date' => 'end_register_date',
            'accreditation_status' => 'accreditation',
            'title' => 'name_ar',
            'en_title' => 'name_en',
            'place' => 'course_place',
            'seats' => 'seating_number',
            'hours' => 'lecture_hours',
            'type' => 'training_type',
            'body' => 'description_en',
            'requirements' => 'requirements_en'
        ];

        $load = Loader::apply($course_mapped, 'mod_lms_course', 'courses');
    }
    public function resolveCourse()
    {
        $courses = Course::all();

        foreach ($courses as $course) {
            if ($course->course_place) {
                switch (trim($course->course_place, ' ')) {
                    case 'local':

                        $course_place = Lookup::where('slug', 'physical_training')->first();

                        break;
                    case 'online':
                        $course_place = Lookup::where('slug', 'live_streaming')->first();
                        break;
                    case 'live':
                        $course_place = Lookup::where('slug', 'live_streaming')->first();
                        break;
                    default:
                        $course_place = Lookup::where('slug', trim($course->course_place))->first();
                        if (!$course_place) {
                            $course_place = Lookup::create([
                                'lookup_type_id' => LookupType::where('slug', 'course_places')->first()->id,
                                'title_en' => $course->course_place,
                                'title_ar' => $course->course_place,
                            ]);
                        }
                        break;
                }
            } else {
                $course_place = null;
            }
            if ($course->training_type) {
                $course_track = Lookup::where('slug', trim($course->training_type, ' '))->first();
                if (!$course_track) {
                    $course_track = Lookup::create([
                        'lookup_type_id' => LookupType::where('slug', 'course_tracks')->first()->id,
                        'title_en' => $course->training_type,
                        'title_ar' => $course->training_type,
                    ]);
                }
            } else {
                $course_track = null;
            }

            if ($course->instructor_id) {
                $course->course_target_group()->sync([$course->instructor_id]);
            }
            $course->update([
                'course_track_id' => $course_track ? $course_track->id : null,
                'course_place_id' => $course_place ? $course_place->id : null
            ]);
        }
    }

    public function userCourses()
    {
        $user_courses = self::migration('user_courses');
        foreach ($user_courses as $t) {
            $t['user_id'] = $t['remote_user_id'];
            $t['course_id'] = $t['remote_course_id'];

            UsersCourse::create($t);
        }

        return true;
    }

    public function sections()
    {
        $course_mapped = [
            'name' => 'title_en',
        ];

        Loader::apply($course_mapped, 'mod_lms_section', 'course_sections');
        return true;
    }
    public function lectures()
    {
        $course_mapped = [
            'section_id' => 'course_section_id',
            'instance_id' => 'title_en',
            'accessibility' => 'accessing',
            'type_id' => 'type'
        ];

        Loader::apply($course_mapped, 'mod_lms_activity', 'course_section_lectures');
    }

    public function resolveLecture()
    {
        $lectures = CourseSectionLecture::all();
        foreach ($lectures as $lecture) {
            switch ($lecture->type) {
                case '6':
                    $meeting = DB::connection('afaq_source')->table('mod_lms_act_meeting')->where('id', $lecture->title_en)->first();
                    if ($meeting) {
                        $lecture->title_en = $meeting->topic;
                        $lecture->title_ar = $meeting->topic;
                        $lecture->type =  'zoom';
                        $lecture->duration = $meeting->duration;
                        $lecture->accessing = $lecture->accessing > 2 ?  'private' : 'public';
                        $lecture->short_description_en = $meeting->topic;
                        $lecture->short_description_ar = $meeting->topic;
                        $lecture->save();
                        ZoomMeeting::updateOrCreate([
                            'course_id' => $lecture->course_id,
                            'section_id' => $lecture->course_lecture_id,
                            'lecture_id' => $lecture->id,
                            'meeting_id' => $meeting->meetingId,
                            'start_url' => $meeting->start_url,
                            'join_url' => $meeting->join_url,
                            'status' => $meeting->status,
                            'all_data' => $meeting->options,
                            'topic' => $meeting->topic,
                            'start_time' => $meeting->start_time,
                            'end_time' => $meeting->start_time,
                            'duration' => $meeting->duration,
                            'agenda' => $meeting->agenda,
                            'host_video' => null,
                            'participant_video' => null,
                            'password' => $meeting->password,
                            'default_password' => '1',
                            'type' => $meeting->meeting_type,
                            'audio' => $meeting->audio,
                            'auto_recording' => $meeting->auto_recording,
                            'alternative_hosts' => $meeting->alternative_hosts,
                            'mute_upon_entry' => $meeting->mute_upon_entry,
                            'watermark' => $meeting->watermark,
                            'waiting_room' => $meeting->wating_room,
                            'meeting_type' => 'meetings',
                        ]);
                    }
                    break;
                case '1':
                    $meeting = DB::connection('afaq_source')->table('mod_lms_act_video')->where('id', $lecture->title_en)->first();
                    if ($meeting) {
                        $options = json_decode($meeting->options);
                        $lecture->title_en = $meeting->name;
                        $lecture->title_ar = $meeting->name;
                        $lecture->type =  'video';
                        $lecture->duration = $options->duration;;
                        $lecture->accessing = $lecture->accessing > 2 ?  'private' : 'public';
                        $lecture->short_description_en = $meeting->name;
                        $lecture->short_description_ar = $meeting->name;
                        $lecture->save();
                    }
                    break;
                case '2':
                    $meeting = DB::connection('afaq_source')->table('mod_lms_act_quiz')->where('id', $lecture->title_en)->first();
                    if ($meeting) {
                        $options = json_decode($meeting->options);
                        $quize_attams = DB::connection('afaq_source')->table('mod_lms_act_quiz_attempt')->where('quiz_id', $lecture->title_en)->first();
                        $quize_def = DB::connection('afaq_source')->table('mod_lms_act_quiz_definition')->where('quiz_id', $lecture->title_en)->first();
                        $question = DB::connection('afaq_source')->table('mod_qb_question')->where('id', $quize_def->question_id ?? null)->first();
                        CourseQuize::updateOrCreate([
                            'id' => $meeting->id,
                            'section_id' => $lecture->course_section_id,
                            'lecture_id' => $lecture->id,
                            'course_id' => $lecture->course_id,
                            'repeat_times' => 1,
                            'exam_title_id' => $question->bank_id ?? 1,
                            'title_en' => $meeting->name,
                            'title_ar' => $meeting->name,
                            'description_en' => $meeting->name,
                            'description_ar' => $meeting->name,
                            'tips_guidelines' => $meeting->name,
                            'success_percentage' => $quize_attams->grade ?? 1,
                            'start_at' => date('Y-m-d', strtotime($options->start_date)),
                            'end_at' => date('Y-m-d', strtotime($options->end_date)),
                            'status' => 1,
                        ]);
                        $lecture->title_en = $meeting->name;
                        $lecture->title_ar = $meeting->name;
                        $lecture->type =  'quize';
                        $lecture->duration = $options->duration;
                        $lecture->accessing = $lecture->accessing > 2 ?  'private' : 'public';
                        $lecture->short_description_en = $meeting->name;
                        $lecture->short_description_ar = $meeting->name;
                        $lecture->save();
                    }
                    break;
                case '4':
                    $meeting = DB::connection('afaq_source')->table('mod_lms_act_resource')->where('id', $lecture->title_en)->first();
                    if ($meeting) {
                        $options = json_decode($meeting->options);
                        $lecture->title_en = $meeting->name;
                        $lecture->title_ar = $meeting->name;
                        $lecture->type =  'file';
                        $lecture->duration = $options->duration;
                        $lecture->accessing = $lecture->accessing > 2 ?  'private' : 'public';
                        $lecture->short_description_en = $meeting->name;
                        $lecture->short_description_ar = $meeting->name;
                        $lecture->save();
                    }
                    break;
                default:
                    # code...
                    break;
            }
        }
    }
    public function partener()
    {
        $parteners = DB::connection('afaq_source')->table('core_partner')->get();

        foreach ($parteners as $part) {
            Lookup::create([
                'title_en' => $part->name,
                'title_ar' => $part->name,
                'slug' => Str::slug($part->name),
                'lookup_type_id' => 5
            ]);
        }
    }

    public function specialities()
    {
        $sp = DB::connection('afaq_source')->table('mod_drcourse_job_title')->get();

        foreach ($sp as $s) {
            Specialty::create([
                'name_en' => $s->name,
                'name_ar' => $s->ar_name,
            ]);
        }

        $sub = DB::connection('afaq_source')->table('mod_drcourse_functional_branch')->get();
        foreach ($sub as $su) {
            SubSpecialty::create([
                'name_en' => $su->name,
                'name_ar' => $su->ar_name,
                'specialty_id' => $su->job_title_id
            ]);
        }

        $course_ses = DB::connection('afaq_source')->table('mod_drcourse_job_title_course')->get();
        foreach ($course_ses as $course_se) {
            DB::table('course_target_group')->insert([
                'course_id' => $course_se->course_id,
                'specialty_id' => $course_se->job_title_id
            ]);
        }
    }

    public function tracks()
    {
        $tracks = DB::connection('afaq_source')->table('mod_sales_topic')->get();
        foreach ($tracks as $track) {
            Lookup::create([
                'title_en' => $track->en_title,
                'title_ar' => $track->name,
                'slug' => Str::slug($track->en_title),
                'lookup_type_id' => 2
            ]);
        }
    }

    public function couponMigrate()
    {
        $coupons = DB::connection('afaq_source')->table('mod_sales_coupon')->get();

        foreach ($coupons as $coupon) {
            CouponCode::create([
                'coupon_text' => $coupon->name,
                'coupon_type' => $coupon->value_type == 'percent' ? 'percentage' : '',
                'coupon_amount' => $coupon->value,
                'coupon_expire_date' => date('d-m-Y', strtotime($coupon->enddate))
            ]);
        }

        return true;
    }

    public function courseCoupons()
    {
        $coupons = DB::connection('afaq_source')->table('mod_sales_coupon_product')->get();

        foreach ($coupons as $coupon) {

            CouponCode::create([
                'course_id' => $coupon->product_id,
                'coupon_code_id' => $coupon->coupon_id
            ]);
        }

        return true;
    }


    public function questionBank()
    {
        $question_banks = DB::connection('afaq_source')->table('mod_qb_question_bank')->get();

        foreach ($question_banks as $question_bank) {

            $exam_title = ExamsTitle::create([
                'id' => $question_bank->id,
                'name_en' => $question_bank->name,
                'name_ar' => $question_bank->name
            ]);
            $questions = DB::connection('afaq_source')->table('mod_qb_question')->where('bank_id', $exam_title->id)->get();
            if (count($questions)) {
                foreach ($questions as $question) {
                    $created_question = QuestionBank::create([
                        'id' => $question->id,
                        'exams_title_id' => $exam_title->id,
                        'title' => $question->body,
                    ]);

                    $answers = DB::connection('afaq_source')->table('mod_qb_question_answer')->where('question_id', $question->id)->get();

                    if (count($answers)) {
                        foreach ($answers as $answer) {
                            QuestionAnswer::create([
                                'question_banks_id' => $question->id,
                                'answer' => $answer->body,
                                'correct_answer' => 0,
                            ]);
                        }
                    }
                }
            }
        }

        return true;
    }

    public function userCourseProgress()
    {
        $user_courses = UsersCourse::all();

        foreach ($user_courses as $user_course) {
            $progress  = DB::connection('afaq_source')->table('mod_lms_course_grade')->where('user_id',$user_course->user_id)->where('course_id',$user_course->course_id)->first();
            if($progress){
                $user_course->update([
                    'completion_percentage' => $progress->progress
                ]);
            }
        }
    }

    public function solve_sub_spec(){
        $users = DB::connection('afaq_source')->table('user')->get();

        foreach ($users as $value) {
           User::where('email',$value->username)->update([
            'sub_specialty_id' => $value->functional_branch_id
           ]);
        }

    }
}
