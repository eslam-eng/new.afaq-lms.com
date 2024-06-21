<?php

namespace App\Http\Controllers\Api\V1\Front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CalculateCourseCompletion;
use App\Http\Requests\QuizAnswerRequest;
use App\Http\Resources\Api\CourseContentResource;
use App\Http\Resources\Api\CourseResource;
use App\Http\Resources\Api\FeaturedResource;
use App\Http\Resources\Api\LectureNoteResource;
use App\Http\Resources\Api\QuestionaireResource;
use App\Http\Resources\Api\QuizeResource;
use App\Models\Answer;
use App\Models\Course;
use App\Models\CourseQuestionaire;
use App\Models\CourseQuestionaireUserAnswar;
use App\Models\CourseQuize;
use App\Models\CourseQuizeScore;
use App\Models\CourseSection;
use App\Models\CourseSectionLecture;
use App\Models\CourseVideoScore;
use App\Models\QuestionAnswer;
use Illuminate\Http\Request;

class CourseApiController extends Controller
{
    use CalculateCourseCompletion;

    public function content($course_id)
    {
        try {
            $course = Course::with('course_instructor', 'sections', 'sections.lectures', 'reviews.user')->where('show_for_all', 1)->where('id', $course_id)->first();
            if (!$course) {
                return $this->toJson(null, 400, 'there is no course with this id', false);
            }

            // return $this->toJson($course);
            return $this->toJson(new CourseResource($course));
        } catch (\Throwable $th) {
            if (config('app.debug')) {
                //throw $th;
                return $this->toJson(null, 400, $th->getMessage(), false);
            }
        }
    }

    public function related_courses($course_id)
    {
        try {
            $course = Course::with('course_instructor', 'sections', 'sections.lectures')->where('show_for_all', 1)->where('id', $course_id)->first();
            if (!$course) {
                return $this->toJson(null, 400, 'there is no course with this id', false);
            }
            $targets = $course->course_targets->pluck('specialty_id');

            $courses = Course::where('id', '!=', $course_id)->where('course_place_id', $course->course_place_id)->where('show_for_all', 1)->whereHas('course_targets', function ($q) use ($targets) {
                $q->whereIn('specialty_id', $targets);
            })->take(8)->get();


            return $this->toJson(FeaturedResource::collection($courses));
        } catch (\Throwable $th) {
            if (config('app.debug')) {
                //throw $th;
                return $this->toJson(null, 400, $th->getMessage(), false);
            }
        }
    }

    public function courseContent(Request $request)
    {
        try {
            $oneCourse = Course::find($request->course_id);
            $lecture_id = $request->lecture_id;
            $section_id = $request->section_id;

            if ($oneCourse) {
                $oneCourse->load(['questionaire.questions.answars', 'category', 'instructor', 'course_instructor', 'media', 'course_Hosted_accreditations', 'course_Cooperated_accreditations', 'course_accreditations', 'course_target', 'sections', 'sections.lectures']);
            } else {
                $this->toJson([], 404, 'Course Not Found');
            }

            // return $oneCourse->toArray();
            return $this->toJson(view('frontend.course-content.index-mobile-call', compact('oneCourse', 'lecture_id', 'section_id'))->render());
        } catch (\Throwable $th) {
            if (config('app.debug')) {
                //throw $th;
                return $this->toJson(null, 400, 'Course Not Found', false);
            }
        }
    }

    public function course_content(Request $request)
    {
        $oneCourse = Course::find($request->course_id);
        $lecture_id = $request->lecture_id;
        $section_id = $request->section_id;
        

        if ($oneCourse) {
            $oneCourse->load(['questionaire.questions.answars', 'category', 'instructor', 'course_instructor', 'media', 'course_Hosted_accreditations', 'course_Cooperated_accreditations', 'course_accreditations', 'course_target', 'sections', 'sections.lectures']);
        }

        if ($oneCourse) {
            $oneCourse = new CourseContentResource($oneCourse);
        }

        return $this->toJson($oneCourse);
    }

    public function course_content_lecture(Request $request)
    {
        $lecture = CourseSectionLecture::find($request->lecture_id);

        if ($lecture) {
            switch ($lecture->type) {
                case 'zoom':
                    $data = $lecture->zoom ? $lecture->zoom->start_url : '';
                    $whatIWant = substr($data, strpos($data, "zak=") + 1);
                    $link = [
                        'link' => $lecture->zoom ? $lecture->zoom->start_url : '',
                        'meeting_number' => $lecture->zoom ? $lecture->zoom->meeting_id : '',
                        'zak' => $whatIWant,
                        'type' => $lecture->type
                    ];
                    break;
                case 'video':
                    $link = [
                        'link' => get_video_to_s3($lecture->file),
                        'type' => $lecture->type,
                        'notes' => count($lecture->courseNotes) ? LectureNoteResource::collection($lecture->courseNotes) : null
                    ];
                    break;
                case 'file':
                    $link = [
                        'link' => $lecture->attachment->url,
                        'type' => $lecture->type
                    ];
                    break;
                case 'photo':
                    $link = [
                        'link' => $lecture->attachment->url,
                        'type' => $lecture->type
                    ];
                    break;
                case 'attendance_design':
                    $link = [
                        'link' => route('admin.get_attendance_design', ['locale' => app()->getLocale(), 'course_id' =>  $lecture->course->id,
                        'attendance_design_id' => $lecture->course->attendance_design->attendance_design_id,
                        'lecture_id' => $lecture->id]),
                        'type' => $lecture->type
                    ];
                    break;
                default:
                    # code...
                    break;
            }
        } else {
            $link = null;
        }

        return $this->toJson($link ?? '');
    }

    public function get_course_questionaire(Request $request)
    {
        $questionaire = CourseQuestionaire::where('course_id', $request->course_id)->with('questions', 'questions.answars')->first();

        if ($questionaire) {
            $questionaire = new QuestionaireResource($questionaire);
        }
        return $this->toJson($questionaire);
    }

    public function get_course_quize(Request $request)
    {
        $quize = CourseQuize::where('lecture_id', $request->lecture_id)->first();

        if ($quize) {
            $quize = new QuizeResource($quize);

            return $this->toJson($quize);
        } else {
            return $this->toJson(null, 400, 'Something Wrong', false);
        }
    }

    public function quizAnswar(QuizAnswerRequest $request)
    {
        try {

            // Store User answers
            $correct_answars = 0;
            foreach ($request->questions as $question) {
                if (isset($question['answer_id'])) {
                    Answer::create([
                        'user_id' => auth()->user()->id,
                        'question_id' => $question['question_id'],
                        'exams_title_id' => $question['exams_title_id'],
                        'answer_id' => $question['answer_id'],
                        'quize_id' => $request->quize_id
                    ]);

                    if (QuestionAnswer::where('id', $question['answer_id'])->where('question_banks_id', $question['question_id'])->where('correct_answer', 1)->exists()) {
                        $correct_answars += 1;
                    }
                }
            }

            // Store User Score in quize
            $quize = CourseQuize::find($request->quize_id);
            $score_percentage = ($correct_answars / $quize->exam_title->questions->count()) * 100;
            $old_score = CourseQuizeScore::where('course_id', $quize->course_id)
                ->where('quize_id', $quize->id)
                ->where('user_id', auth()->user()->id)->first();
            if ($old_score) {
                $old_score->update([
                    'score_percentage' => $score_percentage,
                    'success' => ($score_percentage >= $quize->success_percentage) ? 1 : 0,
                    'repeat_times' => $old_score->repeat_times + 1
                ]);
            } else {
                CourseQuizeScore::create([
                    'course_id' => $quize->course_id,
                    'quize_id' => $quize->id,
                    'user_id' => auth()->user()->id,
                    'score_percentage' => $score_percentage,
                    'success' => ($score_percentage >= $quize->success_percentage) ? 1 : 0,
                    'repeat_times' => 1
                ]);
            }


            // Add User Score precentage to User Course
            $this->updateCourseCompletion($quize->course_id, auth()->user()->id);

            return $this->toJson('');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function questionaire_result(Request $request)
    {
        
        // return $request->all();
        foreach (array_values($request->questions) as $key => $value) {
            if (isset($value['answer_id'])) {
                if ($value['type'] == 'text') {
                    $data['answar_text'] = $value['answar_text'];
                    $data['course_questionaire_question_answar_id'] = null;
                } elseif ($value['type'] == 'true_false') {
                    $data['answar_text'] = (string)$value['answer_id'];
                    $data['course_questionaire_question_answar_id'] = $value['answer_id'];
                } else {
                    $data['answar_text'] = null;
                    $data['course_questionaire_question_answar_id'] = $value['answer_id'];
                }
                $data['user_id'] = auth()->user()->id;
                $data['course_id'] = $value['course_id'];
                $data['course_questionaire_id'] = $value['course_questionaire_id'];
                $data['course_questionaire_question_id'] = $value['course_questionaire_question_id'];

                CourseQuestionaireUserAnswar::firstOrCreate($data);
            }
        }

        return $this->toJson('');
    }

    public function videoResult(Request $request)
    {
        try {
            $lecture = CourseSectionLecture::find($request->lecture_id);
            $watched_duration = $request->watched / 60;
            $duration = $lecture->duration;
            $success_percentage = ($watched_duration / $duration) * 100;
            $display_show_video_duration = gmdate('i:s', $request->watched);

            $data = [
                'show_video_duration' => $request->watched,
                'display_show_video_duration' => $display_show_video_duration,
                'video_duration' => $duration,
                'score_percentage' => $success_percentage,
                'show_time_ranges' => $request->watched,
                'lecture_id' => $lecture->id,
                'course_id' => $lecture->course_id
            ];

            $course_video_score = CourseVideoScore::where('user_id', auth()->user()->id)
                ->where('lecture_id', $request->lecture_id)
                ->where('course_id', $request->course_id)->first();

            if ($course_video_score) {
                $data['score_percentage'] = (isset($data['score_percentage']) && $data['score_percentage'] > $course_video_score->score_percentage) ? $data['score_percentage'] : $course_video_score->score_percentage;
                $course_video_score->update($data);
            } else {
                $data['user_id'] = auth()->user()->id;
                $course_video_score = CourseVideoScore::create($data);
            }

            // Add User Score precentage to User Course
            $this->updateCourseCompletion($course_video_score->course_id, auth()->user()->id);

            return $this->toJson('');
        } catch (\Throwable $th) {
            if (config('app.debug')) {
                //throw $th;
                return $this->toJson(null, 400, $th->getMessage(), false);
            }
        }
    }
}
