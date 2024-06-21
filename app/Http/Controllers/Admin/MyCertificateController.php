<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMyCertificateRequest;
use App\Http\Requests\StoreMyCertificateRequest;
use App\Http\Requests\UpdateMyCertificateRequest;
use App\Models\UserCertificate;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MyCertificateController extends Controller
{
    public function index()
    {
        $user_certificate = UserCertificate::with('certificate:id,name_en,name_ar', 'course')->has('certificate')->has('course')->where(['user_id' => auth()->user()->id])->distinct('course_id','user_id')->get();
        $user_certificate =$user_certificate->unique(['course_id']);
         return view('frontend.personalInfos.my_certificates', compact('user_certificate'));
    }
}
