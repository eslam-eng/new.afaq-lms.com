<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMembershipTypeRequest;
use App\Http\Requests\StoreMembershipTypeRequest;
use App\Http\Requests\UpdateMembershipTypeRequest;
use App\Models\MembershipType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MembershipTypeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('membership_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $membershipTypes = MembershipType::all();

        return view('admin.membershipTypes.index', compact('membershipTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('membership_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.membershipTypes.create');
    }

    public function store(StoreMembershipTypeRequest $request)
    {
        $membershipType = MembershipType::create($request->all());

        return redirect()->route('admin.membership-types.index');
    }

    public function edit(MembershipType $membershipType)
    {
        abort_if(Gate::denies('membership_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.membershipTypes.edit', compact('membershipType'));
    }

    public function update(UpdateMembershipTypeRequest $request, MembershipType $membershipType)
    {
        $membershipType->update($request->all());

        return redirect()->route('admin.membership-types.index');
    }

    public function show(MembershipType $membershipType)
    {
        abort_if(Gate::denies('membership_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.membershipTypes.show', compact('membershipType'));
    }

    public function destroy(MembershipType $membershipType)
    {
        abort_if(Gate::denies('membership_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if(count($membershipType->memberships)){
            return back()->with('error', __('global.delete_fails_member_ship_type'));

        }else{
            $membershipType->delete();
        }

        return back()->with('message', __('global.delete_account_success'));
    }

    public function massDestroy(MassDestroyMembershipTypeRequest $request)
    {
        MembershipType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
