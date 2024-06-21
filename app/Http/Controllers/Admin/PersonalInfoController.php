<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPersonalInfoRequest;
use App\Http\Requests\StorePersonalInfoRequest;
use App\Http\Requests\UpdatePersonalInfoRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PersonalInfoController extends Controller
{
    public function index()
    {
//        abort_if(Gate::denies('personal_info_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.personalInfos.myprofile');
    }

    public function create()
    {
        abort_if(Gate::denies('personal_info_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.personalInfos.create');
    }

    public function store(StorePersonalInfoRequest $request)
    {
        $personalInfo = PersonalInfo::create($request->all());

        return redirect()->route('admin.personal-infos.index');
    }

    public function edit(PersonalInfo $personalInfo)
    {
        abort_if(Gate::denies('personal_info_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.personalInfos.edit', compact('personalInfo'));
    }

    public function update(UpdatePersonalInfoRequest $request, PersonalInfo $personalInfo)
    {
        $personalInfo->update($request->all());

        return redirect()->route('admin.personal-infos.index');
    }

    public function show(PersonalInfo $personalInfo)
    {
        abort_if(Gate::denies('personal_info_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.personalInfos.show', compact('personalInfo'));
    }

    public function destroy(PersonalInfo $personalInfo)
    {
        abort_if(Gate::denies('personal_info_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $personalInfo->delete();

        return back()->with('message', __('global.delete_account_success'));
    }

    public function massDestroy(MassDestroyPersonalInfoRequest $request)
    {
        PersonalInfo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
