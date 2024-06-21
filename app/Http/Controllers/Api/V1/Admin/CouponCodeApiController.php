<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCouponCodeRequest;
use App\Http\Requests\UpdateCouponCodeRequest;
use App\Http\Resources\Admin\CouponCodeResource;
use App\Models\CouponCode;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CouponCodeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('coupon_code_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CouponCodeResource(CouponCode::all());
    }

    public function store(StoreCouponCodeRequest $request)
    {
        $couponCode = CouponCode::create($request->all());

        return (new CouponCodeResource($couponCode))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CouponCode $couponCode)
    {
        abort_if(Gate::denies('coupon_code_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CouponCodeResource($couponCode);
    }

    public function update(UpdateCouponCodeRequest $request, CouponCode $couponCode)
    {
        $couponCode->update($request->all());

        return (new CouponCodeResource($couponCode))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CouponCode $couponCode)
    {
        abort_if(Gate::denies('coupon_code_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $couponCode->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
