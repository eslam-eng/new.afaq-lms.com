<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyNotificationCampainRequest;
use App\Http\Requests\StoreNotificationCampainRequest;
use App\Http\Requests\UpdateNotificationCampainRequest;
use App\Models\NotificationCampain;
use App\Models\Specialty;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NotificationCampainController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('notification_campain_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notificationCampains = NotificationCampain::with(['specialty'])->get();

        return view('admin.notificationCampains.index', compact('notificationCampains'));
    }

    public function create()
    {
        abort_if(Gate::denies('notification_campain_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialties = Specialty::pluck('name_' . app()->getLocale(), 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.notificationCampains.create', compact('specialties'));
    }

    public function store(StoreNotificationCampainRequest $request)
    {
        $notificationCampain = NotificationCampain::create($request->all());

        return redirect()->route('admin.notification-campains.index');
    }

    public function edit(NotificationCampain $notificationCampain)
    {
        abort_if(Gate::denies('notification_campain_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialties = Specialty::pluck('name_' . app()->getLocale(), 'id')->prepend(trans('global.pleaseSelect'), '');

        $notificationCampain->load('specialty');

        return view('admin.notificationCampains.edit', compact('notificationCampain', 'specialties'));
    }

    public function update(UpdateNotificationCampainRequest $request, NotificationCampain $notificationCampain)
    {
        $notificationCampain->update($request->all());

        return redirect()->route('admin.notification-campains.index');
    }

    public function show(NotificationCampain $notificationCampain)
    {
        abort_if(Gate::denies('notification_campain_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notificationCampain->load('specialty');

        return view('admin.notificationCampains.show', compact('notificationCampain'));
    }

    public function destroy(NotificationCampain $notificationCampain)
    {
        abort_if(Gate::denies('notification_campain_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notificationCampain->delete();

        return back();
    }

    public function massDestroy(MassDestroyNotificationCampainRequest $request)
    {
        NotificationCampain::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
