<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySubSpecialtyRequest;
use App\Http\Requests\StoreSubSpecialtyRequest;
use App\Http\Requests\UpdateSubSpecialtyRequest;
use App\Models\Specialty;
use App\Models\SubSpecialty;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubSpecialtyController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sub_specialty_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subSpecialties = SubSpecialty::with(['specialty'])->get();

        return view('admin.subSpecialties.index', compact('subSpecialties'));
    }

    public function create()
    {
        abort_if(Gate::denies('sub_specialty_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialties = Specialty::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.subSpecialties.create', compact('specialties'));
    }

    public function store(StoreSubSpecialtyRequest $request)
    {
        $subSpecialty = SubSpecialty::create($request->all());

        return redirect()->route('admin.sub-specialties.index');
    }

    public function edit(SubSpecialty $subSpecialty)
    {
        abort_if(Gate::denies('sub_specialty_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialties = Specialty::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subSpecialty->load('specialty');

        return view('admin.subSpecialties.edit', compact('specialties', 'subSpecialty'));
    }

    public function update(UpdateSubSpecialtyRequest $request, SubSpecialty $subSpecialty)
    {
        $subSpecialty->update($request->all());

        return redirect()->route('admin.sub-specialties.index');
    }

    public function show(SubSpecialty $subSpecialty)
    {
        abort_if(Gate::denies('sub_specialty_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subSpecialty->load('specialty');

        return view('admin.subSpecialties.show', compact('subSpecialty'));
    }

    public function destroy(SubSpecialty $subSpecialty)
    {
        abort_if(Gate::denies('sub_specialty_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subSpecialty->delete();

        return back()->with('message', __('global.delete_account_success'));
    }

    public function massDestroy(MassDestroySubSpecialtyRequest $request)
    {
        SubSpecialty::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
