<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBusinessFeatureRequest;
use App\Http\Requests\StoreBusinessFeatureRequest;
use App\Http\Requests\UpdateBusinessFeatureRequest;
use App\Models\BusinessFeature;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BusinessFeatureController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('business_feature_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessFeatures = BusinessFeature::with(['media'])->get();

        return view('admin.businessFeatures.index', compact('businessFeatures'));
    }

    public function create()
    {
        abort_if(Gate::denies('business_feature_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.businessFeatures.create');
    }

    public function store(StoreBusinessFeatureRequest $request)
    {
        $businessFeature = BusinessFeature::create($request->all());

        if ($request->input('icon', false)) {
            $businessFeature->addMedia(storage_path('tmp/uploads/' . basename($request->input('icon'))))->toMediaCollection('icon');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $businessFeature->id]);
        }

        return redirect()->route('admin.business-features.index');
    }

    public function edit(BusinessFeature $businessFeature)
    {
        abort_if(Gate::denies('business_feature_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.businessFeatures.edit', compact('businessFeature'));
    }

    public function update(UpdateBusinessFeatureRequest $request, BusinessFeature $businessFeature)
    {
        $businessFeature->update($request->all());

        if ($request->input('icon', false)) {
            if (! $businessFeature->icon || $request->input('icon') !== $businessFeature->icon->file_name) {
                if ($businessFeature->icon) {
                    $businessFeature->icon->delete();
                }
                $businessFeature->addMedia(storage_path('tmp/uploads/' . basename($request->input('icon'))))->toMediaCollection('icon');
            }
        } elseif ($businessFeature->icon) {
            $businessFeature->icon->delete();
        }

        return redirect()->route('admin.business-features.index');
    }

    public function show(BusinessFeature $businessFeature)
    {
        abort_if(Gate::denies('business_feature_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.businessFeatures.show', compact('businessFeature'));
    }

    public function destroy(BusinessFeature $businessFeature)
    {
        abort_if(Gate::denies('business_feature_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessFeature->delete();

        return back();
    }

    public function massDestroy(MassDestroyBusinessFeatureRequest $request)
    {
        $businessFeatures = BusinessFeature::find(request('ids'));

        foreach ($businessFeatures as $businessFeature) {
            $businessFeature->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('business_feature_create') && Gate::denies('business_feature_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new BusinessFeature();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
