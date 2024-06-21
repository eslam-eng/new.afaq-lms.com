<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCouponCodeCourseRequest;
use App\Http\Requests\StoreCouponCodeCourseRequest;
use App\Http\Requests\UpdateCouponCodeCourseRequest;
use App\Models\CouponCode;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CouponCodeCoursesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('coupon_code_course_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $couponCodes = CouponCode::withCount('enrolles')->get();
        return view('admin.reports.couponCodeCourses.index', compact('couponCodes'));
    }

    public function show($couponCode)
    {
        $couponCode = CouponCode::find($couponCode);
        $couponCode->load('courses');
        return view('admin.reports.couponCodeCourses.courses', compact('couponCode'));
    }
}
