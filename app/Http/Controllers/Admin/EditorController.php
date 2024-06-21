<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEditorRequest;
use App\Http\Requests\StoreEditorRequest;
use App\Http\Requests\UpdateEditorRequest;
use App\Models\Editor;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class EditorController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('editor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $editors = Editor::with(['media'])->get();

        return view('admin.editors.index', compact('editors'));
    }

    public function create()
    {
        abort_if(Gate::denies('editor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.editors.create');
    }

    public function store(StoreEditorRequest $request)
    {
        $editor = Editor::create($request->all());

        if ($request->input('image', false)) {
            $editor->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $editor->id]);
        }

        return redirect()->route('admin.editors.index');
    }

    public function edit(Editor $editor)
    {
        abort_if(Gate::denies('editor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.editors.edit', compact('editor'));
    }

    public function update(UpdateEditorRequest $request, Editor $editor)
    {
        $editor->update($request->all());

        if ($request->input('image', false)) {
            if (!$editor->image || $request->input('image') !== $editor->image->file_name) {
                if ($editor->image) {
                    $editor->image->delete();
                }
                $editor->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($editor->image) {
            $editor->image->delete();
        }

        return redirect()->route('admin.editors.index');
    }

    public function show(Editor $editor)
    {
        abort_if(Gate::denies('editor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.editors.show', compact('editor'));
    }

    public function destroy(Editor $editor)
    {
        abort_if(Gate::denies('editor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $editor->delete();

        return back()->with('message', __('global.delete_account_success'));
    }

    public function massDestroy(MassDestroyEditorRequest $request)
    {
        Editor::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('editor_create') && Gate::denies('editor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Editor();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
