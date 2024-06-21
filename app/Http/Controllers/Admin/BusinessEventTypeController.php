<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBusinessEventTypeRequest;
use App\Http\Requests\StoreBusinessEventTypeRequest;
use App\Http\Requests\UpdateBusinessEventTypeRequest;
use App\Models\BusinessEventType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BusinessEventTypeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('business_event_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessEventTypes = BusinessEventType::all();

        return view('admin.businessEventTypes.index', compact('businessEventTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('business_event_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.businessEventTypes.create');
    }

    public function store(StoreBusinessEventTypeRequest $request)
    {
        $businessEventType = BusinessEventType::create($request->all());

        return redirect()->route('admin.business-event-types.index');
    }

    public function edit(BusinessEventType $businessEventType)
    {
        abort_if(Gate::denies('business_event_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.businessEventTypes.edit', compact('businessEventType'));
    }

    public function update(UpdateBusinessEventTypeRequest $request, BusinessEventType $businessEventType)
    {
        $businessEventType->update($request->all());

        return redirect()->route('admin.business-event-types.index');
    }

    public function show(BusinessEventType $businessEventType)
    {
        abort_if(Gate::denies('business_event_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.businessEventTypes.show', compact('businessEventType'));
    }

    public function destroy(BusinessEventType $businessEventType)
    {
        abort_if(Gate::denies('business_event_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessEventType->delete();

        return back();
    }

    public function massDestroy(MassDestroyBusinessEventTypeRequest $request)
    {
        $businessEventTypes = BusinessEventType::find(request('ids'));

        foreach ($businessEventTypes as $businessEventType) {
            $businessEventType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
