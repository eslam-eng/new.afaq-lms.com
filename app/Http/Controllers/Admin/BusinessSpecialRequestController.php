<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBusinessSpecialRequestRequest;
use App\Http\Requests\StoreBusinessSpecialRequestRequest;
use App\Http\Requests\UpdateBusinessSpecialRequestRequest;
use App\Models\BusinessEventType;
use App\Models\BusinessSpecialRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BusinessSpecialRequestController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('business_special_request_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessSpecialRequests = BusinessSpecialRequest::with(['event_type'])->get();

        return view('admin.businessSpecialRequests.index', compact('businessSpecialRequests'));
    }

    public function create()
    {
        abort_if(Gate::denies('business_special_request_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event_types = BusinessEventType::where('status',1)->pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.businessSpecialRequests.create', compact('event_types'));
    }

    public function store(StoreBusinessSpecialRequestRequest $request)
    {
        $businessSpecialRequest = BusinessSpecialRequest::create($request->all());

        return redirect()->route('admin.business-special-requests.index');
    }

    public function edit(BusinessSpecialRequest $businessSpecialRequest)
    {
        abort_if(Gate::denies('business_special_request_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event_types = BusinessEventType::where('status',1)->pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $businessSpecialRequest->load('event_type');

        return view('admin.businessSpecialRequests.edit', compact('businessSpecialRequest', 'event_types'));
    }

    public function update(UpdateBusinessSpecialRequestRequest $request, BusinessSpecialRequest $businessSpecialRequest)
    {
        $businessSpecialRequest->update($request->all());

        return redirect()->route('admin.business-special-requests.index');
    }

    public function show(BusinessSpecialRequest $businessSpecialRequest)
    {
        abort_if(Gate::denies('business_special_request_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessSpecialRequest->load('event_type');

        return view('admin.businessSpecialRequests.show', compact('businessSpecialRequest'));
    }

    public function destroy(BusinessSpecialRequest $businessSpecialRequest)
    {
        abort_if(Gate::denies('business_special_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessSpecialRequest->delete();

        return back();
    }

    public function massDestroy(MassDestroyBusinessSpecialRequestRequest $request)
    {
        $businessSpecialRequests = BusinessSpecialRequest::find(request('ids'));

        foreach ($businessSpecialRequests as $businessSpecialRequest) {
            $businessSpecialRequest->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
