<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBusinessMedicalTypeRequest;
use App\Http\Requests\StoreBusinessMedicalTypeRequest;
use App\Http\Requests\UpdateBusinessMedicalTypeRequest;
use App\Models\BusinessMedicalType;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BusinessMedicalTypeController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('business_medical_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessMedicalTypes = BusinessMedicalType::with(['media'])->get();

        return view('admin.businessMedicalTypes.index', compact('businessMedicalTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('business_medical_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.businessMedicalTypes.create');
    }

    public function store(StoreBusinessMedicalTypeRequest $request)
    {
        $businessMedicalType = BusinessMedicalType::create($request->all());

        foreach ($request->input('image', []) as $file) {
            $businessMedicalType->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $businessMedicalType->id]);
        }

        return redirect()->route('admin.business-medical-types.index');
    }

    public function edit(BusinessMedicalType $businessMedicalType)
    {
        abort_if(Gate::denies('business_medical_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.businessMedicalTypes.edit', compact('businessMedicalType'));
    }

    public function update(UpdateBusinessMedicalTypeRequest $request, BusinessMedicalType $businessMedicalType)
    {
        $businessMedicalType->update($request->all());

        if (count($businessMedicalType->image) > 0) {
            foreach ($businessMedicalType->image as $media) {
                if (! in_array($media->file_name, $request->input('image', []))) {
                    $media->delete();
                }
            }
        }
        $media = $businessMedicalType->image->pluck('file_name')->toArray();
        foreach ($request->input('image', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $businessMedicalType->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
            }
        }

        return redirect()->route('admin.business-medical-types.index');
    }

    public function show(BusinessMedicalType $businessMedicalType)
    {
        abort_if(Gate::denies('business_medical_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.businessMedicalTypes.show', compact('businessMedicalType'));
    }

    public function destroy(BusinessMedicalType $businessMedicalType)
    {
        abort_if(Gate::denies('business_medical_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessMedicalType->delete();

        return back();
    }

    public function massDestroy(MassDestroyBusinessMedicalTypeRequest $request)
    {
        $businessMedicalTypes = BusinessMedicalType::find(request('ids'));

        foreach ($businessMedicalTypes as $businessMedicalType) {
            $businessMedicalType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('business_medical_type_create') && Gate::denies('business_medical_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new BusinessMedicalType();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
