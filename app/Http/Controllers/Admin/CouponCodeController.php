<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCouponCodeRequest;
use App\Http\Requests\StoreCouponCodeRequest;
use App\Http\Requests\UpdateCouponCodeRequest;
use App\Models\CouponCode;
use App\Models\Course;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CouponCodeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('coupon_code_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $couponCodes = CouponCode::with(['course'])->get();

        return view('admin.couponCodes.index', compact('couponCodes'));
    }

    public function create()
    {
        abort_if(Gate::denies('coupon_code_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $courses = Course::pluck('name_' . app()->getLocale() . ' as name', 'id');

        return view('admin.couponCodes.create', compact('courses'));
    }

    public function store(Request $request)
    {
        //        dd($request);
        //        $couponCode = CouponCode::create($request->all());
        $input = $request->all();
        $now = date('Y-m-d', strtotime(now()));
        $request->validate([
            'course_id' => 'required|array',
            'course_id.*' => 'required|integer',
            'coupon_text' => 'string|required|unique:coupon_codes,coupon_text',
            'coupon_type' => 'required',
            'coupon_expire_date' => ['required','after_or_equal:'.$now],
        ]);

        if ($request->coupon_type == 'percentage' && ((int)$request->coupon_amount > 100 || (int)$request->coupon_amount < 0)) {
            $request->validate([
                'coupon_amount' =>  'numeric|min:1|max:100',
            ]);
        }

        $input['coupon_expire_date'] = date('d-m-Y', strtotime($input['coupon_expire_date']));
        $couponCode = CouponCode::create($input);
        $couponCode->course_coupon()->sync($request->course_id);

        return redirect()->route('admin.coupon-codes.index');
    }

    public function edit(CouponCode $couponCode)
    {
        abort_if(Gate::denies('coupon_code_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $courses = Course::pluck('name_' . app()->getLocale() . ' as name', 'id');
        $course_coupon_selected_array = $couponCode->course_coupon->pluck('pivot.course_id')->toArray();

        $couponCode->load('course', 'course_coupon');
        return view('admin.couponCodes.edit', compact('couponCode', 'courses', 'course_coupon_selected_array'));
    }

    public function update(Request $request, CouponCode $couponCode)
    {
        $input = $request->all();
        $todayDate = date('m/d/Y');
        $request->validate([
            'course_id' => 'required|array',
            'course_id.*' => 'required|integer',
            'coupon_text' => 'string|required|unique:coupon_codes,coupon_text,'.$couponCode->id,
            'coupon_type' => 'required',
            'coupon_expire_date' => ['required', 'after_or_equal:' . $todayDate],
        ]);

        if ($request->coupon_type == 'percentage' && ((int)$request->coupon_amount > 100 || (int)$request->coupon_amount < 0)) {
            $request->validate([
                'coupon_amount' =>  'numeric|min:1|max:100',
            ]);
        }
        $input['coupon_expire_date'] = date('d-m-Y', strtotime($input['coupon_expire_date']));
        $couponCode->update($input);
        $couponCode->course_coupon()->sync($request->course_id);

        return redirect()->route('admin.coupon-codes.index');
    }

    public function show(CouponCode $couponCode)
    {
        abort_if(Gate::denies('coupon_code_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $couponCode->load('course');

        return view('admin.couponCodes.show', compact('couponCode'));
    }

    public function destroy(CouponCode $couponCode)
    {
        abort_if(Gate::denies('coupon_code_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $couponCode->delete();

        return back()->with('message', __('global.delete_account_success'));
    }

    public function massDestroy(MassDestroyCouponCodeRequest $request)
    {
        CouponCode::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
