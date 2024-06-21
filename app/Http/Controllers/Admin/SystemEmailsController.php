<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySystemEmailRequest;
use App\Http\Requests\StoreSystemEmailRequest;
use App\Http\Requests\UpdateSystemEmailRequest;
use App\Models\Course;
use App\Models\Exam;
use App\Models\SystemEmail;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SystemEmailsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('system_email_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $system_emails = SystemEmail::all();
        $system_emails_types = SystemEmail::$system_emails_types;
        $system_emails_names = SystemEmail::$system_emails_names;

        return view('admin.systemEmails.index', compact('system_emails', 'system_emails_types', 'system_emails_names'));
    }
    public function testmail()
    {
    }

    public function create()
    {
        abort_if(Gate::denies('system_email_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $system_emails_types = SystemEmail::$system_emails_types;
        $system_emails_names = SystemEmail::$system_emails_names;
        $courses = Course::pluck('name_' . app()->getLocale() . ' as name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $exams = Exam::pluck('title_' . app()->getLocale() . ' as title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.systemEmails.create', compact('system_emails_types', 'system_emails_names','courses','exams'));
    }

    public function search(Request $request)
    {
        if ($request->mail_type == "1") {
            $sys = SystemEmail::where('type', '=', $request->mail_type)->where('name_id', '=', $request->name_id)->first();
        } elseif ($request->mail_type == "2") {
            $sys = SystemEmail::where('type', '=', $request->mail_type)->where('name_id', '=', $request->name_id)->first();
            $default_sys = SystemEmail::where('type', '=', "1")->where('name_id', '=', $request->name_id)->first();
        } elseif ($request->mail_type == "3") {
            $sys = SystemEmail::where('type', '=', $request->mail_type)->where('name_id', '=', $request->name_id)->where('course_id', '=', $request->course_id)->first();
            $default_sys = SystemEmail::where('type', '=', "1")->where('name_id', '=', $request->name_id)->first();
        }
        if (!empty($sys)) {
            $return = array("existin_url" => url('') . "/admin/system-emails/" . $sys->id . "/edit");;
        }
        if (!empty($default_sys)) {
            $return["default_subject"] = $default_sys->subject;
            $return["default_content"] = $default_sys->message;
        }
        if (!empty($return)) {
            return json_encode($return);
        }
        return false;
    }

    public function store(StoreSystemEmailRequest $request)
    {
        $system_emails_names = SystemEmail::$system_emails_names;
        $sent_data = $request->all();
        $sent_data['name'] = $system_emails_names[$sent_data['name_id']];
        $system_email = SystemEmail::create($sent_data);

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $system_email->id]);
        }

        return redirect()->route('admin.system-emails.index');
    }

    public function edit(SystemEmail $system_email)
    {
        abort_if(Gate::denies('system_email_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $system_emails_types = SystemEmail::$system_emails_types;
        $system_emails_names = SystemEmail::$system_emails_names;
        $courses = Course::pluck('name_' . app()->getLocale() . ' as name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $exams = Exam::pluck('title_' . app()->getLocale() . ' as title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.systemEmails.edit', compact('system_email',
            'system_emails_types', 'system_emails_names','courses','exams'));
    }

    public function update(UpdateSystemEmailRequest $request, SystemEmail $system_email)
    {
        $system_emails_names = SystemEmail::$system_emails_names;
        $sent_data = $request->all();
        $sent_data['name'] = $system_emails_names[$sent_data['name_id']];

        $system_email->update($sent_data);

        return redirect()->route('admin.system-emails.index');
    }

    public function show(SystemEmail $system_email)
    {
        abort_if(Gate::denies('system_email_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.systemEmails.show', compact('system_email'));
    }

    public function destroy(SystemEmail $system_email)
    {
        abort_if(Gate::denies('system_email_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $system_email->delete();

        return back()->with('message', __('global.delete_account_success'));
    }

    public function massDestroy(MassDestroySystemEmailRequest $request)
    {
        SystemEmail::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('system_email_create') && Gate::denies('system_email_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SystemEmail();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

}
