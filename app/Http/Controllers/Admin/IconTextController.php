<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyIconTextRequest;
use App\Http\Requests\StoreIconTextRequest;
use App\Http\Requests\UpdateIconTextRequest;
use App\Models\IconText;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class IconTextController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('icon_text_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $iconTexts = IconText::with(['media'])->get();

        return view('admin.iconTexts.index', compact('iconTexts'));
    }

    public function create()
    {
        abort_if(Gate::denies('icon_text_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.iconTexts.create');
    }

    public function store(StoreIconTextRequest $request)
    {
        $iconText = IconText::create($request->all());

        if ($request->input('image', false)) {
            $iconText->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $iconText->id]);
        }

        return redirect()->route('admin.icon-texts.index');
    }

    public function edit(IconText $iconText)
    {
        abort_if(Gate::denies('icon_text_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.iconTexts.edit', compact('iconText'));
    }

    public function update(UpdateIconTextRequest $request, IconText $iconText)
    {
        $iconText->update($request->all());

        if ($request->input('image', false)) {
            if (!$iconText->image || $request->input('image') !== $iconText->image->file_name) {
                if ($iconText->image) {
                    $iconText->image->delete();
                }
                $iconText->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($iconText->image) {
            $iconText->image->delete();
        }

        return redirect()->route('admin.icon-texts.index');
    }

    public function show(IconText $iconText)
    {
        abort_if(Gate::denies('icon_text_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.iconTexts.show', compact('iconText'));
    }

    public function destroy(IconText $iconText)
    {
        abort_if(Gate::denies('icon_text_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $iconText->delete();

        return back()->with('message', __('global.delete_account_success'));
    }

    public function massDestroy(MassDestroyIconTextRequest $request)
    {
        IconText::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('icon_text_create') && Gate::denies('icon_text_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new IconText();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
