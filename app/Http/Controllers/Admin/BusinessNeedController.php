<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBusinessNeedRequest;
use App\Http\Requests\StoreBusinessNeedRequest;
use App\Http\Requests\UpdateBusinessNeedRequest;
use App\Models\BusinessNeed;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BusinessNeedController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('business_need_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessNeeds = BusinessNeed::with(['media'])->get();

        return view('admin.businessNeeds.index', compact('businessNeeds'));
    }

    public function create()
    {
        abort_if(Gate::denies('business_need_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.businessNeeds.create');
    }

    public function store(StoreBusinessNeedRequest $request)
    {
        $businessNeed = BusinessNeed::create($request->all());

        if ($request->input('icon', false)) {
            $businessNeed->addMedia(storage_path('tmp/uploads/' . basename($request->input('icon'))))->toMediaCollection('icon');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $businessNeed->id]);
        }

        return redirect()->route('admin.business-needs.index');
    }

    public function edit(BusinessNeed $businessNeed)
    {
        abort_if(Gate::denies('business_need_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.businessNeeds.edit', compact('businessNeed'));
    }

    public function update(UpdateBusinessNeedRequest $request, BusinessNeed $businessNeed)
    {
        $businessNeed->update($request->all());

        if ($request->input('icon', false)) {
            if (! $businessNeed->icon || $request->input('icon') !== $businessNeed->icon->file_name) {
                if ($businessNeed->icon) {
                    $businessNeed->icon->delete();
                }
                $businessNeed->addMedia(storage_path('tmp/uploads/' . basename($request->input('icon'))))->toMediaCollection('icon');
            }
        } elseif ($businessNeed->icon) {
            $businessNeed->icon->delete();
        }

        return redirect()->route('admin.business-needs.index');
    }

    public function show(BusinessNeed $businessNeed)
    {
        abort_if(Gate::denies('business_need_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.businessNeeds.show', compact('businessNeed'));
    }

    public function destroy(BusinessNeed $businessNeed)
    {
        abort_if(Gate::denies('business_need_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessNeed->delete();

        return back();
    }

    public function massDestroy(MassDestroyBusinessNeedRequest $request)
    {
        $businessNeeds = BusinessNeed::find(request('ids'));

        foreach ($businessNeeds as $businessNeed) {
            $businessNeed->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('business_need_create') && Gate::denies('business_need_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new BusinessNeed();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
