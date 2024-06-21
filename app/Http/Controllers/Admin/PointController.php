<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPointDataRequest;
use App\Models\Point;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PointController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('point_data_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointDatas = Point::with(['user'])->get();

        return view('admin.points.index', compact('pointDatas'));
    }

    public function show(Point $pointData)
    {
        abort_if(Gate::denies('point_data_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointData->load('user');

        return view('admin.points.show', compact('pointData'));
    }

    public function destroy(Point $pointData)
    {
        abort_if(Gate::denies('point_data_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointData->delete();

        return back();
    }

    /**
     * Add Point Balance
     */
    public function addPoint(Request $request)
    {
        $pointData = Point::find($request->point_id);
        if ($pointData) {

            $pointData->update(['points' => $request->extra_balance + $pointData->points]);

            return true;
        }

        return false;
    }

    /**
     * @param Request $request
     * Subtract Point balance
     */
    public function subPoint(Request $request)
    {

        $pointData = Point::find($request->point_id);

        if ($pointData) {
            if ($request->sub_balance > $request->points) {
                return false;
            } else {

                $pointData->update(['points' =>  $pointData->points - $request->sub_balance]);

                return true;
            }
        }

        return false;
    }
}
