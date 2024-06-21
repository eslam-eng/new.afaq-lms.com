<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySpecialtyRequest;
use App\Http\Requests\StoreSpecialtyRequest;
use App\Http\Requests\UpdateSpecialtyRequest;
use App\Models\Specialty;
use App\Models\SubSpecialty;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SpecialtyController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('specialty_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialties = Specialty::whereNull('deleted_at')
            ->get();

        return view('admin.specialties.index', compact('specialties'));
    }

    public function create()
    {
        abort_if(Gate::denies('specialty_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.specialties.create');
    }

    public function store(StoreSpecialtyRequest $request)
    {
        $specialty = Specialty::create($request->all());

        return redirect()->route('admin.specialties.index');
    }

    public function edit(Specialty $specialty)
    {
        abort_if(Gate::denies('specialty_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.specialties.edit', compact('specialty'));
    }

    public function update(UpdateSpecialtyRequest $request, Specialty $specialty)
    {
        $specialty->update($request->all());

        return redirect()->route('admin.specialties.index');
    }

    public function show(Specialty $specialty)
    {
        abort_if(Gate::denies('specialty_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.specialties.show', compact('specialty'));
    }

    public function destroy(Specialty $specialty)
    {
        abort_if(Gate::denies('specialty_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialty->delete();
        $specialty->subcategories()->delete();

        return back()->with('message', __('global.delete_account_success'));
    }

    public function massDestroy(MassDestroySpecialtyRequest $request)
    {
        Specialty::whereIn('id', request('ids'))->delete();
        //        Specialty::whereIn('id', request('ids'))->subcategories()->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function get_specialty($lang, $id)
    {
        $id = explode(',', $id);
        return SubSpecialty::whereIn('specialty_id', $id)
            // ->select('name_' . app()->getLocale() . ' as name', 'name_en as en', 'name_ar as ar', 'id')
            ->get();
    }
    /**
     *
     * Sorting Specialty View
     */
    public function specialtiesView()
    {
        $panddingprovider = Specialty::select('name_' . app()->getLocale() . ' as s_name', 'id')
            ->where('show_in_homePage', 0)
            ->orderBy('order')
            ->get();
        $completeprovider = Specialty::select('name_' . app()->getLocale() . ' as s_name', 'id')
            ->where('show_in_homePage', 1)
            ->orderBy('order')
            ->get();
        return view('admin.specialties.reorder', compact('panddingprovider', 'completeprovider'));
    }
    public function sortSpecialties(Request $request)
    {
        $input = $request->all();

        if (!empty($input['pending'])) {
            foreach ($input['pending'] as $key => $value) {
                $key = $key + 1;
                Specialty::where('id', $value)
                    ->update([
                        'show_in_homePage' => 0,
                        'order' => $key
                    ]);
            }
        }

        if (!empty($input['show_in_homePage'])) {
            foreach ($input['show_in_homePage'] as $key => $value) {
                $key = $key + 1;
                Specialty::where('id', $value)
                    ->update([
                        'show_in_homePage' => 1,
                        'order' => $key
                    ]);
            }
        }
        return response()->json(['status' => 'data Sorted Successfully ']);
    }
}
