<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPointActionRequest;
use App\Models\PointAction;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PointActionsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('point_action_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointActions = PointAction::with(['user', 'from_user'])->get();

        return view('admin.pointActions.index', compact('pointActions'));
    }

    public function show(PointAction $pointAction)
    {
        abort_if(Gate::denies('point_action_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointAction->load('user', 'from_user');

        return view('admin.pointActions.show', compact('pointAction'));
    }

    public function destroy(PointAction $pointAction)
    {
        abort_if(Gate::denies('point_action_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointAction->delete();

        return back();
    }

    public function massDestroy(MassDestroyPointActionRequest $request)
    {
        PointAction::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
