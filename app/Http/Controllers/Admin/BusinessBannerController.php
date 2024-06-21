<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBusinessBannerRequest;
use App\Http\Requests\StoreBusinessBannerRequest;
use App\Http\Requests\UpdateBusinessBannerRequest;
use App\Models\BusinessBanner;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BusinessBannerController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('business_banner_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessBanners = BusinessBanner::all();

        return view('admin.businessBanners.index', compact('businessBanners'));
    }

    public function create()
    {
        abort_if(Gate::denies('business_banner_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.businessBanners.create');
    }

    public function store(StoreBusinessBannerRequest $request)
    {
        $businessBanner = BusinessBanner::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $businessBanner->id]);
        }

        return redirect()->route('admin.business-banners.index');
    }

    public function edit(BusinessBanner $businessBanner)
    {
        abort_if(Gate::denies('business_banner_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.businessBanners.edit', compact('businessBanner'));
    }

    public function update(UpdateBusinessBannerRequest $request, BusinessBanner $businessBanner)
    {
        $businessBanner->update($request->all());

        return redirect()->route('admin.business-banners.index');
    }

    public function show(BusinessBanner $businessBanner)
    {
        abort_if(Gate::denies('business_banner_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.businessBanners.show', compact('businessBanner'));
    }

    public function destroy(BusinessBanner $businessBanner)
    {
        abort_if(Gate::denies('business_banner_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessBanner->delete();

        return back();
    }

    public function massDestroy(MassDestroyBusinessBannerRequest $request)
    {
        $businessBanners = BusinessBanner::find(request('ids'));

        foreach ($businessBanners as $businessBanner) {
            $businessBanner->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('business_banner_create') && Gate::denies('business_banner_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new BusinessBanner();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
