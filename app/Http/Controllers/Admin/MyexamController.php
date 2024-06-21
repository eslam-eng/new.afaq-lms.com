<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Certificat;
use App\Models\CertificateKey;
use App\Models\Exam;
use App\Models\QuestionBank;
use App\Models\UserCertificate;
use App\Models\UserExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class MyexamController extends Controller
{
    public function index()
    {
        $my_exam = UserExam::with('exam')->where('user_id', auth()->user()->id)->paginate(12);
        return view('frontend.personalInfos.my_exams', compact('my_exam'));
    }

    public function go_to_exam($lang, $exam_id)
    {
        if (UserExam::where(['user_id' => auth()->user()->id, 'exam_id' => $exam_id])->first()) {
            $exam = Exam::select(
                'id',
                'title_' . app()->getLocale() . ' as title',
                'description_' . app()->getLocale() . ' as description',
                'tips_guidelines',
                'success_percentage',
                'price',
                'start_at',
                'end_at'
            )->find($exam_id);

            return view('frontend.exam.exam_tips', compact('exam'));
        }

        return back()->with('error', 'this exam not belong to you');
    }

    public function start_exam($lang, $exam_id)
    {
        $questions = [];
        $answer_id = null;
        $answer = null;
        $user_exam = UserExam::where(['user_id' => auth()->user()->id, 'exam_id' => $exam_id])->first();
        if ($user_exam) {
            $exam = Exam::select(
                'id',
                'title_' . app()->getLocale() . ' as title',
                'description_' . app()->getLocale() . ' as description',
                'tips_guidelines',
                'success_percentage',
                'price',
                'start_at',
                'end_at',
                'number_question'
            )->with('exam_content')->find($exam_id);


            if ($exam) {
                try {
                    $this->save_log(auth()->user()->id, "The user: " . auth()->user()->name . " start " + $exam->title + " exam.");
                } catch (\Throwable $th) {
                    //throw $th;
                }
                $sections = $exam->exam_content->pluck('exams_title_id');
                if ($sections) {
                    $total_questions = $exam->number_question ?? QuestionBank::whereIn('exams_title_id', $sections)->count();
                    $questions = QuestionBank::whereIn('exams_title_id', $sections)->paginate(1);
                    $question = isset($questions->toArray()['data'][0]) ? $questions->toArray()['data'][0] : null;
                    if ($question && isset($question['exams_title_id']) && isset($question['id'])) {
                        $answer = Answer::select('answer_id', 'flag')->where([
                            'user_id' => auth()->user()->id,
                            'exam_id' => $exam->id,
                            'exams_title_id' => $question['exams_title_id'],
                            'question_id' => $question['id'],
                            'date' => date('Y-m-d')
                        ])->first();
                        if ($answer) {
                            $answer_id = $answer->answer_id;
                        }
                    }
                }

                if (request()->ajax()) {
                    return ['url' => url(app()->getLocale() . "/start_exam/" . $exam_id . "?page=" . (request('page', 1)))];
                }

                return view('frontend.exam.start_exam', compact('questions', 'exam', 'answer_id', 'total_questions', 'answer'));
            }
        }

        return back()->with('error', 'this exam not belong to you');
    }

    public function set_answer(Request $request)
    {
        $user = auth()->user();
        $data = $request->except('_token');
        $data['user_id'] = $user->id;
        $data['date'] = date('Y-m-d');

        $check = $data;
        unset($check['answer_id']);
        unset($check['flag']);
        $answer = Answer::updateOrCreate($check, $data);
        if ($answer) {
            return true;
        }
        return false;
    }

    public function get_reviews(Request $request)
    {
        $user = auth()->user();
        $exam = Exam::select('id')->with('exam_content')->find($request->exam_id);
        $sections = $exam->exam_content->pluck('exams_title_id');
        $questions = QuestionBank::with(['answer' => function ($q) use ($user) {
            $q->latest()->where('user_id', $user->id);
        }])->whereIn('exams_title_id', $sections)->get();

        return $questions;
    }

    public function exam_results($lang, $exam_id)
    {
        $my_exam = UserExam::where(['user_id' => auth()->user()->id, 'exam_id' => $exam_id])->first();
        if ($my_exam->complete || strtotime($my_exam->exam->end_at) < strtotime(now())) {
            $exam = Exam::with('exam_content', 'exam_content.exam_title.questions.answer', 'exam_content.exam_title.questions.answer.question_answer')->where(['id' => $exam_id])->first();
            try {
                $this->save_log(auth()->user()->id, "The user: " . auth()->user()->name . " view " . $exam->title_en . " results.");
            } catch (\Throwable $th) {
                //throw $th;
            }
            return view('frontend.exam.exam_result', compact('exam'));
        } else {
            return back();
        }
    }

    public function end_exam()
    {
        $my_exam = UserExam::where('exam_id', request('exam_id'))->where('user_id', auth()->user()->id)->first();
        $my_exam->update(['complete' => 1]);
        try {
            $this->save_log(auth()->user()->id, "The user: " . auth()->user()->name . " End " + $my_exam->exam->title_en + " exam.");
        } catch (\Throwable $th) {
            //throw $th;
        }
        return redirect()->route('admin.my_exams', ['locale' => app()->getLocale()]);
    }

    public function get_certificate()
    {
        try {
            $user_certificate = UserCertificate::firstOrCreate(['user_id' => auth()->user()->id, 'course_id' => request('course_id'), 'exam_id' => request('exam_id'), 'certificate_id' => request('certificate_id')]);
            $certificate = Certificat::find(request('certificate_id'));

            $canvas_json = json_decode($certificate->content, true);


            // if (!$user_certificate->qrcode) {
                $qrcode = \QrCode::format("png")->size(200)->generate((route('view.certificate', [
                    'exam_id' => $user_certificate->exam_id,
                    'course_id' => $user_certificate->course_id,
                    'certificate_id' => $user_certificate->certificate_id,
                    'user_id' => $user_certificate->user_id
                ])));
                $qr_img = "data:image/png;base64, " . base64_encode($qrcode);
                $user_certificate->qrcode = $qr_img;
                $user_certificate->save();
            // }

            if (isset($canvas_json['objects'])) {
                foreach ($canvas_json['objects'] as $k => $value) {
                    if (isset($value['type']) && ($value['type'] == 'i-text' || $value['type'] == 'textbox')) {
                        $key = CertificateKey::where('key', $value['text'])->first();
                        try {
                            if ($key) {
                                if ($key->type == 'App\Models\User') {
                                    $value['text'] = (string)DB::table('users')->where('id', $user_certificate->user_id)->first()->{$key->related_coulmn} ?? '';
                                }
                                if ($key->type == 'App\Models\Course') {
                                    $value['text'] = (string)DB::table('courses')->where('id', $user_certificate->course_id)->first()->{$key->related_coulmn} ?? '';
                                }
                                if ($key->type == 'App\Models\Exam') {
                                    $value['text'] = (string)DB::table('exams')->where('id', $user_certificate->exam_id)->first()->{$key->related_coulmn} ?? '';
                                }
                            }
                        } catch (\Throwable $th) {
                            //throw $th;
                        }
                    } elseif (isset($value['type']) && $value['type'] == 'image' && $value['src'] == 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRdKgmfKEMbsxqE4WwPeUQDYeqb619rnPvUnciLyJG_WLWKw5S7t6qRHlw0AcH7PcbRnQY&usqp=CAU') {
                        $value['src'] = $user_certificate->qrcode;
                    }
                    $canvas_json['objects'][$k] = $value;
                }
            }

            $user_certificate->update(['certificate_img' => $canvas_json]);
            try {
                $this->save_log(auth()->user()->id, "The user: " . auth()->user()->name . " Get " . $certificate->name_en . " Certificate.");
            } catch (\Throwable $th) {
                //throw $th;
            }

            return view('cert', compact('certificate', 'canvas_json', 'user_certificate'));
        } catch (\Throwable $th) {
            // throw $th;
            return back();
        }

        // $pdf = PDF::loadHTML($certificate->content, [
        //     'format' => 'A4-L'
        //   ])->stream('certificate.pdf');
        // return $pdf;
    }

    public function get_certificate_img()
    {
        $certificate = Certificat::find(request('certificate_id'));
        $user_certificate = UserCertificate::firstOrCreate(['user_id' => request('user_id'), 'course_id' => request('course_id'), 'exam_id' => request('exam_id'), 'certificate_id' => request('certificate_id')]);
        // $user_certificate = UserCertificate::firstOrCreate(['user_id' => request('user_id'), 'exam_id' => request('exam_id'), 'certificate_id' => request('certificate_id')]);

        return view('cert2', compact('certificate', 'user_certificate'));
    }

    public function save_certificate()
    {
        // $user_certificate = UserCertificate::firstOrCreate(['user_id' => request('user_id'), 'exam_id' => request('exam_id'), 'certificate_id' => request('certificate_id')]);
        $user_certificate = UserCertificate::firstOrCreate(['user_id' => request('user_id'), 'course_id' => request('course_id'), 'exam_id' => request('exam_id'), 'certificate_id' => request('certificate_id')]);
        $user_certificate->update(['certificate_img' => request('certificate_img')]);
        return true;
    }

    public function viewCertificate()
    {
        try {
            $user_certificate = UserCertificate::firstOrCreate(['user_id' => request('user_id'), 'course_id' => request('course_id'), 'exam_id' => request('exam_id'), 'certificate_id' => request('certificate_id')]);
            $certificate = Certificat::find(request('certificate_id'));

            $canvas_json = json_decode($certificate->content, true);


            if (!$user_certificate->qrcode) {
                $qrcode = \QrCode::format("png")->size(200)->generate((route('view.certificate', [
                    'exam_id' => $user_certificate->exam_id,
                    'course_id' => $user_certificate->course_id,
                    'certificate_id' => $user_certificate->certificate_id,
                    'user_id' => $user_certificate->user_id
                ])));
                $qr_img = "data:image/png;base64, " . base64_encode($qrcode);
                $user_certificate->qrcode = $qr_img;
                $user_certificate->save();
            }

            if (isset($canvas_json['objects'])) {
                foreach ($canvas_json['objects'] as $k => $value) {
                    if (isset($value['type']) && ($value['type'] == 'i-text' || $value['type'] == 'textbox')) {
                        $key = CertificateKey::where('key', $value['text'])->first();
                        try {
                            if ($key) {
                                if ($key->type == 'App\Models\User') {
                                    $value['text'] = (string)DB::table('users')->where('id', $user_certificate->user_id)->first()->{$key->related_coulmn} ?? '';
                                }
                                if ($key->type == 'App\Models\Course') {
                                    $value['text'] = (string)DB::table('courses')->where('id', $user_certificate->course_id)->first()->{$key->related_coulmn} ?? '';
                                }
                                if ($key->type == 'App\Models\Exam') {
                                    $value['text'] = (string)DB::table('exams')->where('id', $user_certificate->exam_id)->first()->{$key->related_coulmn} ?? '';
                                }
                            }
                        } catch (\Throwable $th) {
                            //throw $th;
                        }
                    } elseif (isset($value['type']) && $value['type'] == 'image' && $value['src'] == 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRdKgmfKEMbsxqE4WwPeUQDYeqb619rnPvUnciLyJG_WLWKw5S7t6qRHlw0AcH7PcbRnQY&usqp=CAU') {
                        $value['src'] = $user_certificate->qrcode;
                    }
                    $canvas_json['objects'][$k] = $value;
                }
            }

            $user_certificate->update(['certificate_img' => $canvas_json]);
            try {
                $this->save_log(auth()->user()->id, "The user: " . auth()->user()->name . " Get " . $certificate->name_en . " Certificate.");
            } catch (\Throwable $th) {
                //throw $th;
            }
            return view('frontend.view-certificate', compact('certificate', 'canvas_json', 'user_certificate'));

        } catch (\Throwable $th) {
            // throw $th;
            return back();
        }

        // $pdf = PDF::loadHTML($certificate->content, [
        //     'format' => 'A4-L'
        //   ])->stream('certificate.pdf');
        // return $pdf;
    }
}
