<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEditorRequest;
use App\Http\Requests\UpdateEditorRequest;
use App\Http\Resources\Admin\EditorResource;
use App\Models\Editor;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EditorApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('editor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EditorResource(Editor::all());
    }

    public function store(StoreEditorRequest $request)
    {
        $editor = Editor::create($request->all());

        return (new EditorResource($editor))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Editor $editor)
    {
        abort_if(Gate::denies('editor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EditorResource($editor);
    }

    public function update(UpdateEditorRequest $request, Editor $editor)
    {
        $editor->update($request->all());

        return (new EditorResource($editor))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Editor $editor)
    {
        abort_if(Gate::denies('editor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $editor->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
