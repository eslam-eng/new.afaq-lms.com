<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EnrollItem;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnrollmentController extends Controller
{
    public function index()
    {
//        abort_if(Gate::denies('enrollment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enrollments = EnrollItem::with(['course','user','enroll'])->get();
        return view('admin.enrollments.index', compact('enrollments'));
    }

    public function show(EnrollItem $enrollment)
    {
        abort_if(Gate::denies('enrollment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $enrollment->load('course','user','enroll','enroll.enroll_payment');
        return view('admin.enrollments.show', compact('enrollment'));
    }


}
