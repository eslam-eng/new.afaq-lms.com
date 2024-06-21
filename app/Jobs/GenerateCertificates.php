<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;

use App\Notifications\CertificateExportingNotification;

use App\Models\Certificat;
use App\Models\CertificateKey;
use App\Models\Course;
use App\Models\Exam;
use App\Models\CourseCertificate;
use App\Models\Enroll;
use App\Models\User;
use App\Models\UserCertificate;
use App\Models\UsersCourse;

use App\Mail\CertificateExportingMail;

use QrCode;

class GenerateCertificates implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $timeout = 0;
    public $tries = 3;

    protected $course_id;
    protected $recipientEmail;
    protected $user_id;

    public function __construct($course_id, $recipientEmail, $user_id = null)
    {
        $this->course_id = $course_id;
        $this->recipientEmail = $recipientEmail;
        $this->user_id = $user_id;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $course = Course::find($this->course_id);

        $pass_course_users = UsersCourse::where('course_id', $course->id)
            ->when($this->user_id, fn ($query) => $query->where('user_id', $this->user_id))
            ->when(!$this->user_id, function($query) use ($course){
                $query->where('completion_percentage', '>=', $course->success_percentage);
            })
            ->select('user_id', 'completion_percentage')
            ->get();

        $course_certificate = CourseCertificate::where('course_id', $course->id)->first();
        $certificate = Certificat::find($course_certificate->certificate_id);
        $canvas_json = json_decode($certificate->content, true);
        $keysMap = $this->getKeysMap($canvas_json, $pass_course_users, $course, $certificate);

        $userCertificatesToUpdate = [];
        $usersToSendNotification = [];

        foreach ($pass_course_users as $course_user) {
            $user_certificate = UserCertificate::firstOrCreate([
                'user_id' => $course_user->user_id,
                'course_id' => $course->id,
                'certificate_id' => $certificate->id
            ]);

            if (!$user_certificate->certificate_img) {
                $userCertificateToUpdate = [
                    'id' => $user_certificate->id,
                ];

                try {
                    if (!$user_certificate->qrcode) {
                        $usersToSendNotification[] = $user_certificate->user_id;

                        $qrcodeData = [
                            'exam_id' => $user_certificate->exam_id,
                            'course_id' => $user_certificate->course_id,
                            'certificate_id' => $user_certificate->certificate_id,
                            'user_id' => $user_certificate->user_id,
                        ];

                        $cacheKey = 'qrcode_' . $user_certificate->id;
                        $minutes = 60; // Set the desired cache duration in minutes

                        $qrcode = QrCode::format("png")->size(200)->generate(route('view.certificate', $qrcodeData));

                        $qr_img = "data:image/png;base64, " . base64_encode($qrcode);

                        $user_certificate->update(['qrcode' => $qr_img]);
                    }
                } catch (\Throwable $th) {

                }

                if (isset($canvas_json['objects'])) {
                    $canvas_json = $this->updateCanvasJsonObjects($canvas_json, $user_certificate, $keysMap);

                    $user_certificate->update(['certificate_img' => $canvas_json]);
                }
            }
        }

        UserCertificate::upsert($userCertificatesToUpdate, ['id'], ['qrcode']);

        $users = User::whereIntegerInRaw('id', $usersToSendNotification)->get();
        Notification::send($users, new CertificateExportingNotification($course));

        if($this->recipientEmail){
            Mail::to($this->recipientEmail)->send(new CertificateExportingMail);
        }

        if($this->user_id == null){
            $course->update([
                'is_generating_in_progress' => 0
            ]);
        }
    }

    private function getKeysMap($canvas_json, $users_courses, $course, $certificate){
        $keys = collect($canvas_json['objects'])
            ->filter(function ($value) {
                return isset($value['type']) && ($value['type'] == 'i-text' || $value['type'] == 'textbox');
            })
            ->pluck('text');

        $certificateKeys = CertificateKey::whereIn('key', $keys)->select('key', 'type', 'related_coulmn')->get();

        $usersIds = $users_courses->pluck('user_id');
        $users = User::whereIntegerInRaw('id', $usersIds)->get();
        $examsIds = UserCertificate::whereIntegerInRaw('user_id', $usersIds)->where('course_id', $course->id)->where('certificate_id', $certificate->id)->select('exam_id')->distinct()->pluck('exam_id');
        $exams = Exam::whereIntegerInRaw('id', $examsIds)->get();

        $keyMap = $certificateKeys->map(function ($key) use ($users, $exams, $course) {
            return [
                'key' => $key->key,
                'type' => $key->type,
                'related_coulmn' => $key->related_coulmn,
                'user' => $users->keyBy('id'),
                'course' => $course,
                'exam' => $exams->keyBy('id'),
            ];
        })->keyBy('key');

        return $keyMap;
    }

    private function updateCanvasJsonObjects($canvas_json, $user_certificate, $keyMap)
    {
        $generalSrc = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRdKgmfKEMbsxqE4WwPeUQDYeqb619rnPvUnciLyJG_WLWKw5S7t6qRHlw0AcH7PcbRnQY&usqp=CAU';

        foreach ($canvas_json['objects'] as $k => &$value) {
            if (isset($value['type']) && ($value['type'] == 'i-text' || $value['type'] == 'textbox')) {
                $key = $keyMap->get($value['text']);

                try {
                    $value['text'] = $this->getRelatedText($key, $value, $user_certificate);
                } catch (\Throwable $th) {

                }
            } elseif (isset($value['type']) && $value['type'] == 'image' && $value['src'] == $generalSrc) {
                $value['src'] = $user_certificate->qrcode;
            }
        }

        return $canvas_json;
    }

    private function getRelatedText($key, $value, $user_certificate)
    {
        if (!$key) {
            return $value['text'];
        }

        switch ($key['type']) {
            case 'App\Models\User':
                return $key['user'][$user_certificate->user_id]->{$key['related_coulmn']} ?? '';
            case 'App\Models\Course':
                return $key['course']->{$key['related_coulmn']} ?? '';
            case 'App\Models\Exam':
                return $key['exam'][$user_certificate->exam_id]->{$key['related_coulmn']} ?? '';
            default:
                return '';
        }
    }
}
