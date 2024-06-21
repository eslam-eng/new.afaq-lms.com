<?php

namespace App\Http\Controllers\Api\V1\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\FeaturedResource;
use App\Http\Resources\MyCertificateResource;
use App\Http\Resources\MyInvoicesResource;
use App\Models\Certificat;
use App\Models\Course;
use App\Models\Payment;
use App\Models\UserCertificate;
use App\Models\UsersCourse;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class ProfileApiController extends Controller
{

    public function myCertificates()
    {
        $data = $user_certificate = UserCertificate::with('certificate:id,name_en,name_ar', 'course')->has('certificate')->has('course')->where(['user_id' => auth()->user()->id])->latest()->get();

        $data = $data->unique(['course_id']);
        if (!empty($data)) {
            return $this->toJson(MyCertificateResource::collection($data));
        } else {
            return $this->toJson([]);
        }
    }

    public function myinvoices()
    {
        $payments = Payment::with('payment_details')->where('status_response', 'not like', '% "status":"Failed" %')->has('payment_enrolls')->where('user_id', auth()->user()->id)->latest()->get();

        return $this->toJson(MyInvoicesResource::collection($payments));
    }

    public function myCourses()
    {
        $courses = Course::withoutGlobalScopes()->whereNull('deleted_at')
        ->whereHas('payment_details_accepted', function ($q) {
            $q->where('user_id', auth()->user()->id);
        })->whereHas('user_course');
        $courses = $courses->get(); //->groupBy('coursePlace.slug');

        $data = [];

        foreach ($courses as $key => $value) {
            if (strtotime($value->end_date) < strtotime(now())) {
                $data[0]['key'] = 'finished';
                $data[0]['title'] = __('home.finished');
                $data[0]['items'][] = new FeaturedResource($value);
            }
            // else if ($value['user_course']['completion_percentage'] >= $value->success_percentage) {
            // }
            elseif ($value['coursePlace']['slug'] == 'recorded') {
                $data[1]['key'] = 'recorded';
                $data[1]['title'] = __('home.recorded');
                $data[1]['items'][] = new FeaturedResource($value);
            } else {
                $data[2]['key'] = 'in_progress';
                $data[2]['title'] =  __('home.in_progress');
                $data[2]['items'][] = new FeaturedResource($value);
            }
        }

        return $this->toJson(array_values($data));
    }
}
