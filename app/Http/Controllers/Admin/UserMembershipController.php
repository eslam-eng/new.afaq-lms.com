<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserMembershipRequest;
use App\Http\Requests\StoreUserMembershipRequest;
use App\Http\Requests\UpdateUserMembershipRequest;
use App\Models\MembershipType;
use App\Models\User;
use App\Models\UserMembership;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class UserMembershipController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('user_membership_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userMemberships = UserMembership::with(['user', 'member_type', 'media'])->get();

        return view('admin.userMemberships.index', compact('userMemberships'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_membership_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $member_types = MembershipType::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.userMemberships.create', compact('member_types', 'users'));
    }

    public function store(StoreUserMembershipRequest $request)
    {
        $userMembership = UserMembership::create($request->all());

        if ($request->input('file', false)) {
            $userMembership->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        return redirect()->route('admin.user-memberships.index');
    }

    public function edit(UserMembership $userMembership)
    {
        abort_if(Gate::denies('user_membership_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $member_types = MembershipType::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userMembership->load('user', 'member_type');

        return view('admin.userMemberships.edit', compact('member_types', 'userMembership', 'users'));
    }

    public function update(UpdateUserMembershipRequest $request, UserMembership $userMembership)
    {
        $userMembership->update($request->all());

        if ($request->input('file', false)) {
            if (!$userMembership->file || $request->input('file') !== $userMembership->file->file_name) {
                if ($userMembership->file) {
                    $userMembership->file->delete();
                }
                $userMembership->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
            }
        } elseif ($userMembership->file) {
            $userMembership->file->delete();
        }

        return redirect()->route('admin.user-memberships.index');
    }

    public function show(UserMembership $userMembership)
    {
        abort_if(Gate::denies('user_membership_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userMembership->load('user', 'member_type', 'membershipUsers');
        return view('admin.userMemberships.show', compact('userMembership'));
    }

    public function destroy(UserMembership $userMembership)
    {
        abort_if(Gate::denies('user_membership_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userMembership->delete();

        return back()->with('message', __('global.delete_account_success'));
    }

    public function massDestroy(MassDestroyUserMembershipRequest $request)
    {
        UserMembership::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('user_membership_create') && Gate::denies('user_membership_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new UserMembership();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
    /**
     * Change Status
     */
    public function ChangeStatus(Request $request)
    {
        $input = $request->all();
        $Membership = UserMembership::find($request->userMembership_id);
        $Membership->status = $request->status;
        $Membership->save();
        return response()->json(['success' => 'Status change successfully.']);
    }

}
