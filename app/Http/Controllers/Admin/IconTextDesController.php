<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyIconTextDeRequest;
use App\Http\Requests\StoreIconTextDeRequest;
use App\Http\Requests\UpdateIconTextDeRequest;
use App\Models\IconTextDe;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class IconTextDesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('icon_text_de_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $iconTextDes = IconTextDe::with(['media'])->get();

        return view('admin.iconTextDes.index', compact('iconTextDes'));
    }

    public function create()
    {
        abort_if(Gate::denies('icon_text_de_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.iconTextDes.create');
    }

    public function store(StoreIconTextDeRequest $request)
    {
        $iconTextDe = IconTextDe::create($request->all());

        if ($request->input('icon', false)) {
            $iconTextDe->addMedia(storage_path('tmp/uploads/' . basename($request->input('icon'))))->toMediaCollection('icon');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $iconTextDe->id]);
        }

        return redirect()->route('admin.icon-text-des.index');
    }

    public function edit(IconTextDe $iconTextDe)
    {
        abort_if(Gate::denies('icon_text_de_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.iconTextDes.edit', compact('iconTextDe'));
    }

    public function update(UpdateIconTextDeRequest $request, IconTextDe $iconTextDe)
    {
        $iconTextDe->update($request->all());

        if ($request->input('icon', false)) {
            if (!$iconTextDe->icon || $request->input('icon') !== $iconTextDe->icon->file_name) {
                if ($iconTextDe->icon) {
                    $iconTextDe->icon->delete();
                }
                $iconTextDe->addMedia(storage_path('tmp/uploads/' . basename($request->input('icon'))))->toMediaCollection('icon');
            }
        } elseif ($iconTextDe->icon) {
            $iconTextDe->icon->delete();
        }

        return redirect()->route('admin.icon-text-des.index');
    }

    public function show(IconTextDe $iconTextDe)
    {
        abort_if(Gate::denies('icon_text_de_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.iconTextDes.show', compact('iconTextDe'));
    }

    public function destroy(IconTextDe $iconTextDe)
    {
        abort_if(Gate::denies('icon_text_de_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $iconTextDe->delete();

        return back()->with('message', __('global.delete_account_success'));
    }

    public function massDestroy(MassDestroyIconTextDeRequest $request)
    {
        IconTextDe::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('icon_text_de_create') && Gate::denies('icon_text_de_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new IconTextDe();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
