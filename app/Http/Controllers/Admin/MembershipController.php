<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMembershipRequest;
use App\Http\Requests\StoreMembershipRequest;
use App\Http\Requests\UpdateMembershipRequest;
use App\Models\Membership;
use App\Models\MembershipType;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class MembershipController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('membership_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $memberships = Membership::with(['membership_type'])->get();

        return view('admin.memberships.index', compact('memberships'));
    }

    public function create()
    {
        abort_if(Gate::denies('membership_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $membership_types = MembershipType::pluck('name_'.app()->getLocale(), 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.memberships.create', compact('membership_types'));
    }

    public function store(StoreMembershipRequest $request)
    {
        $membership = Membership::create($request->all());

        return redirect()->route('admin.memberships.index');
    }

    public function edit(Membership $membership)
    {
        abort_if(Gate::denies('membership_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $membership_types = MembershipType::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $membership->load('membership_type');

        return view('admin.memberships.edit', compact('membership', 'membership_types'));
    }

    public function update(UpdateMembershipRequest $request, Membership $membership)
    {
        $membership->update($request->all());

        return redirect()->route('admin.memberships.index');
    }

    public function show(Membership $membership)
    {
        abort_if(Gate::denies('membership_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $membership->load('membership_type');

        return view('admin.memberships.show', compact('membership'));
    }

    public function destroy(Membership $membership)
    {
        abort_if(Gate::denies('membership_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $membership->delete();

        return back()->with('message', __('global.delete_account_success'));
    }

    public function massDestroy(MassDestroyMembershipRequest $request)
    {
        Membership::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
    public function frontmembership()
    {
//        abort_if(Gate::denies('membership_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $membershipTypes = MembershipType::where('status','1')->get();
        $memberships = Membership::with(['membership_type'])->get();
//dd($memberships->toArray());
        return view('frontend.memberships' ,compact('memberships','membershipTypes'));
    }
}
