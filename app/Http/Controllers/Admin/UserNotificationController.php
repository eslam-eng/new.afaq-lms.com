<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserNotificationRequest;
use App\Http\Requests\StoreUserNotificationRequest;
use App\Http\Requests\UpdateUserNotificationRequest;
use App\Models\User;
use App\Models\UserNotification;
use App\Models\UserToken;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserNotificationController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_notification_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userNotifications = UserNotification::with(['user'])->get();

        return view('admin.userNotifications.index', compact('userNotifications'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_notification_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.userNotifications.create', compact('users'));
    }

    public function store(StoreUserNotificationRequest $request)
    {
        $userNotification = SendNotification(
            [
                'title_en' => $request->title_en,
                'title_ar' => $request->title_ar,
                'message_en' => $request->message_en,
                'message_ar' => $request->message_ar,
            ],
            UserToken::where('user_id', $request->user_id)->get()
        );
        //UserNotification::create($request->all());

        return redirect()->route('admin.user-notifications.index');
    }

    public function edit(UserNotification $userNotification)
    {
        abort_if(Gate::denies('user_notification_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userNotification->load('user');

        return view('admin.userNotifications.edit', compact('userNotification', 'users'));
    }

    public function update(UpdateUserNotificationRequest $request, UserNotification $userNotification)
    {
        // $userNotification->update($request->all());

        $userNotification = SendNotification(
            [
                'title_en' => $request->title_en,
                'title_ar' => $request->title_ar,
                'message_en' => $request->message_en,
                'message_ar' => $request->message_ar,
            ],
            UserToken::where('user_id', $request->user_id)->get()
        );

        return redirect()->route('admin.user-notifications.index');
    }

    public function show(UserNotification $userNotification)
    {
        abort_if(Gate::denies('user_notification_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userNotification->load('user');

        return view('admin.userNotifications.show', compact('userNotification'));
    }

    public function destroy(UserNotification $userNotification)
    {
        abort_if(Gate::denies('user_notification_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userNotification->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserNotificationRequest $request)
    {
        UserNotification::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
