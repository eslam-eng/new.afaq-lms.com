<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPointTypeValueRequest;
use App\Http\Requests\StorePointTypeValueRequest;
use App\Http\Requests\UpdatePointTypeValueRequest;
use App\Models\PointType;
use App\Models\PointTypeValue;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PointTypeValueController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('point_type_value_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointTypeValues = PointTypeValue::with(['point_type'])->get();

        return view('admin.pointTypeValues.index', compact('pointTypeValues'));
    }

    public function create()
    {
        abort_if(Gate::denies('point_type_value_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $point_types = PointType::where('status', 1)->pluck('name_' . app()->getLocale(), 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.pointTypeValues.create', compact('point_types'));
    }

    public function store(StorePointTypeValueRequest $request)
    {
        $pointTypeValue = PointTypeValue::create($request->all());

        return redirect()->route('admin.point-type-values.index');
    }

    public function edit(PointTypeValue $pointTypeValue)
    {
        abort_if(Gate::denies('point_type_value_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $point_types = PointType::where('status', 1)->pluck('name_' . app()->getLocale(), 'id')->prepend(trans('global.pleaseSelect'), '');

        $pointTypeValue->load('point_type');

        return view('admin.pointTypeValues.edit', compact('pointTypeValue', 'point_types'));
    }

    public function update(UpdatePointTypeValueRequest $request, PointTypeValue $pointTypeValue)
    {
        $pointTypeValue->update($request->all());

        return redirect()->route('admin.point-type-values.index');
    }

    public function show(PointTypeValue $pointTypeValue)
    {
        abort_if(Gate::denies('point_type_value_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointTypeValue->load('point_type');

        return view('admin.pointTypeValues.show', compact('pointTypeValue'));
    }

    public function destroy(PointTypeValue $pointTypeValue)
    {
        abort_if(Gate::denies('point_type_value_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointTypeValue->delete();

        return back();
    }

    public function massDestroy(MassDestroyPointTypeValueRequest $request)
    {
        PointTypeValue::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
