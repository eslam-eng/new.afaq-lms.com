<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCancelationPolicyRequest;
use App\Http\Requests\StoreCancelationPolicyRequest;
use App\Http\Requests\UpdateCancelationPolicyRequest;
use App\Models\CancelationPolicy;
use App\Models\CancelationPolicyValue;
use App\Models\Course;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CancelationPolicyController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cancelation_policy_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cancelationPolicies = CancelationPolicy::with(['course'])->get();

        return view('admin.cancelationPolicies.index', compact('cancelationPolicies'));
    }

    public function create()
    {
        abort_if(Gate::denies('cancelation_policy_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::pluck('name_' . app()->getLocale() . ' as name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.cancelationPolicies.create', compact('courses'));
    }

    public function store(StoreCancelationPolicyRequest $request)
    {
        $cancelationPolicy = CancelationPolicy::create($request->except(['cancelation_policy_values']));

        if (isset($request->cancelation_policy_values) && !empty($request->cancelation_policy_values)) {
            foreach ($request->cancelation_policy_values as $cancelation_policy_value) {
                $cancelation_policy_value['cancelation_policy_id'] = $cancelationPolicy->id;
                CancelationPolicyValue::create($cancelation_policy_value);
            }
        }
        return redirect()->route('admin.cancelation-policies.index');
    }

    public function edit(CancelationPolicy $cancelationPolicy)
    {
        abort_if(Gate::denies('cancelation_policy_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cancelationPolicy->load('course');

        return view('admin.cancelationPolicies.edit', compact('cancelationPolicy', 'courses'));
    }

    public function update(UpdateCancelationPolicyRequest $request, CancelationPolicy $cancelationPolicy)
    {
        $cancelationPolicy->update($request->except(['cancelation_policy_values']));

        if (isset($request->cancelation_policy_values) && !empty($request->cancelation_policy_values)) {
            CancelationPolicyValue::where('cancelation_policy_id', $cancelationPolicy->id)->delete();
            foreach ($request->cancelation_policy_values as $cancelation_policy_value) {
                $cancelation_policy_value['cancelation_policy_id'] = $cancelationPolicy->id;
                CancelationPolicyValue::create($cancelation_policy_value);
            }
        }

        return redirect()->route('admin.cancelation-policies.index');
    }

    public function show(CancelationPolicy $cancelationPolicy)
    {
        abort_if(Gate::denies('cancelation_policy_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cancelationPolicy->load('course');

        return view('admin.cancelationPolicies.show', compact('cancelationPolicy'));
    }

    public function destroy(CancelationPolicy $cancelationPolicy)
    {
        abort_if(Gate::denies('cancelation_policy_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cancelationPolicy->delete();

        return back()->with('message', __('global.delete_account_success'));
    }

    public function massDestroy(MassDestroyCancelationPolicyRequest $request)
    {
        CancelationPolicy::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
