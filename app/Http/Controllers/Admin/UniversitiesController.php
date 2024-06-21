<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUniversityRequest;
use App\Http\Requests\StoreUniversityRequest;
use App\Http\Requests\UpdateUniversityRequest;
use App\Models\University;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class UniversitiesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('university_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $universities = University::with(['media'])->get();

        return view('admin.universities.index', compact('universities'));
    }

    public function create()
    {
        abort_if(Gate::denies('university_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.universities.create');
    }

    public function store(StoreUniversityRequest $request)
    {
        $university = University::create($request->all());

        if ($request->input('logo', false)) {
            $university->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $university->id]);
        }

        return redirect()->route('admin.universities.index');
    }

    public function edit(University $university)
    {
        abort_if(Gate::denies('university_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.universities.edit', compact('university'));
    }

    public function update(UpdateUniversityRequest $request, University $university)
    {
        $university->update($request->all());

        if ($request->input('logo', false)) {
            if (!$university->logo || $request->input('logo') !== $university->logo->file_name) {
                if ($university->logo) {
                    $university->logo->delete();
                }
                $university->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
            }
        } elseif ($university->logo) {
            $university->logo->delete();
        }

        return redirect()->route('admin.universities.index');
    }

    public function show(University $university)
    {
        abort_if(Gate::denies('university_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.universities.show', compact('university'));
    }

    public function destroy(University $university)
    {
        abort_if(Gate::denies('university_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $university->delete();

        return back()->with('message', __('global.delete_account_success'));
    }

    public function massDestroy(MassDestroyUniversityRequest $request)
    {
        University::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('university_create') && Gate::denies('university_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new University();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
