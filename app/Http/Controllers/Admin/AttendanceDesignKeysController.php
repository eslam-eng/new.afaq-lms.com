<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAttendanceDesignKeyRequest;
use App\Http\Requests\StoreAttendanceDesignKeyRequest;
use App\Http\Requests\UpdateAttendanceDesignKeyRequest;
use App\Models\AttendanceDesignKey;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AttendanceDesignKeysController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('attendance_design_key_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attendanceDesignKeys = AttendanceDesignKey::all();

        return view('admin.attendanceDesignKeys.index', compact('attendanceDesignKeys'));
    }

    public function create()
    {
        abort_if(Gate::denies('attendance_design_key_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.attendanceDesignKeys.create');
    }

    public function store(StoreAttendanceDesignKeyRequest $request)
    {
        $attendanceDesignKey = AttendanceDesignKey::create($request->all());

        return redirect()->route('admin.attendance-design-keys.index');
    }

    public function edit(AttendanceDesignKey $attendanceDesignKey)
    {
        abort_if(Gate::denies('attendance_design_key_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.attendanceDesignKeys.edit', compact('attendanceDesignKey'));
    }

    public function update(UpdateAttendanceDesignKeyRequest $request, AttendanceDesignKey $attendanceDesignKey)
    {
        $attendanceDesignKey->update($request->all());

        return redirect()->route('admin.attendance-design-keys.index');
    }

    public function show(AttendanceDesignKey $attendanceDesignKey)
    {
        abort_if(Gate::denies('attendance_design_key_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.attendanceDesignKeys.show', compact('attendanceDesignKey'));
    }

    public function destroy(AttendanceDesignKey $attendanceDesignKey)
    {
        abort_if(Gate::denies('attendance_design_key_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attendanceDesignKey->delete();

        return back();
    }

    public function massDestroy(MassDestroyAttendanceDesignKeyRequest $request)
    {
        AttendanceDesignKey::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
    public function get_type_data()
    {
        $model = request('type');
        if ($model) {

            $object = new $model;
            if ($model == 'App\Models\User') {
                return $object->getFillable();
            } else {
                return $object->getFillable();
            }
        }
        return [];
    }
}
