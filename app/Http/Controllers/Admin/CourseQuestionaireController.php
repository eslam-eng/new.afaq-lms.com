<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Controllers\Traits\MediaUploadTrait;
use App\Http\Requests\StoreCourseQuestionaireRequest;
use App\Http\Requests\UpdateCourseQuestionaireRequest;
use App\Models\Course;
use App\Models\CourseQuestionaire;
use App\Models\CourseQuestionaireQuestion;
use App\Models\CourseQuestionaireQuestionAnswar;
use App\Models\CourseQuestionaireUserAnswar;
use App\Models\Review;
use Illuminate\Http\Request;

class CourseQuestionaireController extends Controller
{
    use MediaUploadTrait;

    public function index(Request $request)
    {
        $questionaire = CourseQuestionaire::where('course_id', $request->course_id)->first();
        $course_id = $request->course_id;
        if (!$questionaire) {
            return view('admin.courses.courseQuestionaire.create', compact('course_id'));
        } else {
            return view('admin.courses.courseQuestionaire.update', compact('course_id', 'questionaire'));
        }
    }

    public function show($id)
    {
        $data = Review::with('user')->where('course_id', $id)->get();
        $oneCourse = Course::find($id);
        return view('admin.courses.courseQuestionaire.index', compact('data', 'oneCourse'));
    }

    public function show_result($course_id, $user_id)
    {
        $questionaire = CourseQuestionaire::where('course_id', $course_id)->first();

        $result = CourseQuestionaireUserAnswar::where(['user_id' => $user_id, 'course_questionaire_id' => $questionaire->id, 'course_id' => $course_id])->get();

        return view('admin.courses.courseQuestionaire.result', compact('course_id', 'questionaire', 'result'));
    }
    public function showIndex($course_id)
    {
        $data = CourseQuestionaireUserAnswar::with('user')->where('course_id', $course_id)->get();

        $oneCourse = Course::find($course_id);
        return view('admin.courses.courseQuestionaire.index', compact('data', 'oneCourse'));
    }

    public function store(StoreCourseQuestionaireRequest $request)
    {
        $course_id = $request->course_id;

        // Create Course Questionaire
        $questionaire = CourseQuestionaire::create([
            'course_id' => $request->course_id,
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
        ]);

        // Add Questionaire Questions and Answars
        if ($questionaire) {
            if ($request->questions && !empty($request->questions)) {
                foreach ($request->questions as $question) {
                    // Create Questionaire Questions
                    $questionaire_question = CourseQuestionaireQuestion::create([
                        'course_id' => $request->course_id,
                        'course_questionaire_id' => $questionaire->id,
                        'title_en' => $question['title_en'],
                        'title_ar' => $question['title_ar'],
                        'type' => $question['type']
                    ]);

                    // Attach uploaded file to question
                    if (isset($question['file']) && is_file($question['file'])) {
                        $attachment = $this->storeMedia($question['file']);
                        $questionaire_question->addMedia(storage_path('tmp/uploads/' . basename($attachment->name)))->toMediaCollection('questionaire_attachment');
                    }

                    // Check if question is created and create answars if question type (select, multi_select)
                    if ($questionaire_question) {
                        if (isset($question['answars']) && !empty($question['answars'])) {
                            foreach ($question['answars'] as $answar) {
                                if (isset($answar['title_en']) && !is_null($answar['title_en']) && isset($answar['title_en']) && !is_null($answar['title_en'])) {
                                    $questionaire_question_answer = CourseQuestionaireQuestionAnswar::create([
                                        'course_id' => $request->course_id,
                                        'course_questionaire_id' => $questionaire->id,
                                        'course_questionaire_question_id' => $questionaire_question->id,
                                        'title_en' => $answar['title_en'],
                                        'title_ar' => $answar['title_ar'],
                                    ]);
                                }
                            }
                        }
                    }
                }
            }
        }

        return view('admin.courses.courseQuestionaire.update', compact('course_id', 'questionaire'));
    }

    public function update(UpdateCourseQuestionaireRequest $request, $id)
    {
        $course_id = $request->course_id;

        $questionaire = CourseQuestionaire::find($request->questionaire_id);

        // Add Questionaire Questions and Answars
        if ($questionaire) {
            // Create Course Questionaire
            $questionaire->update([
                'course_id' => $request->course_id,
                'title_en' => $request->title_en,
                'title_ar' => $request->title_ar,
            ]);
            if ($request->questions && !empty($request->questions)) {
                CourseQuestionaireQuestion::where('course_id', $course_id)->where('course_questionaire_id', $questionaire->id)->delete();

                foreach ($request->questions as $question) {
                    // Create Questionaire Questions
                    $questionaire_question = CourseQuestionaireQuestion::create([
                        'course_id' => $request->course_id,
                        'course_questionaire_id' => $questionaire->id,
                        'title_en' => $question['title_en'],
                        'title_ar' => $question['title_ar'],
                        'type' => $question['type']
                    ]);

                    // Attach uploaded file to question
                    if (isset($question['file']) && is_file($question['file'])) {
                        $attachment = $this->storeMedia($question['file'])->getData();

                        $questionaire_question->addMedia(storage_path('tmp/uploads/' . basename($attachment->name)))->toMediaCollection('questionaire_attachment');
                    }

                    // Check if question is created and create answars if question type (select, multi_select)
                    if ($questionaire_question) {
                        if (isset($question['answars']) && !empty($question['answars'])) {
                            CourseQuestionaireQuestionAnswar::where('course_id', $request->course_id)
                                ->where('course_questionaire_id', $questionaire->id)
                                ->where('course_questionaire_question_id', $questionaire_question->id)
                                ->delete();
                            foreach ($question['answars'] as $answar) {
                                if (isset($answar['title_en']) && !is_null($answar['title_en']) && isset($answar['title_en']) && !is_null($answar['title_en'])) {
                                    $questionaire_question_answer = CourseQuestionaireQuestionAnswar::create([
                                        'course_id' => $request->course_id,
                                        'course_questionaire_id' => $questionaire->id,
                                        'course_questionaire_question_id' => $questionaire_question->id,
                                        'title_en' => $answar['title_en'],
                                        'title_ar' => $answar['title_ar'],
                                    ]);
                                }
                            }
                        }
                    }
                }
            }
        }

        return redirect()->route('admin.courses.index'); //courseQuestionaire.update', compact('course_id', 'questionaire'));
    }

    public function ChangeStatusReview(Request $request)
    {
        $input = $request->all();
        $review = Review::where('user_id', $request->user_id)->where('id', $request->id)->first();
        $review->status = $request->status;
        $review->save();
        return response()->json(['success' => 'Status change successfully.']);
    }
}
