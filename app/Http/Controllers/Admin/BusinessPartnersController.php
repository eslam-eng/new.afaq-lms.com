<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBusinessPartnerRequest;
use App\Http\Requests\StoreBusinessPartnerRequest;
use App\Http\Requests\UpdateBusinessPartnerRequest;
use App\Models\BusinessPartner;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BusinessPartnersController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('business_partner_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessPartners = BusinessPartner::with(['media'])->get();

        return view('admin.businessPartners.index', compact('businessPartners'));
    }

    public function create()
    {
        abort_if(Gate::denies('business_partner_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.businessPartners.create');
    }

    public function store(StoreBusinessPartnerRequest $request)
    {
        $businessPartner = BusinessPartner::create($request->all());

        if ($request->input('image', false)) {
            $businessPartner->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $businessPartner->id]);
        }

        return redirect()->route('admin.business-partners.index');
    }

    public function edit(BusinessPartner $businessPartner)
    {
        abort_if(Gate::denies('business_partner_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.businessPartners.edit', compact('businessPartner'));
    }

    public function update(UpdateBusinessPartnerRequest $request, BusinessPartner $businessPartner)
    {
        $businessPartner->update($request->all());

        if ($request->input('image', false)) {
            if (! $businessPartner->image || $request->input('image') !== $businessPartner->image->file_name) {
                if ($businessPartner->image) {
                    $businessPartner->image->delete();
                }
                $businessPartner->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($businessPartner->image) {
            $businessPartner->image->delete();
        }

        return redirect()->route('admin.business-partners.index');
    }

    public function show(BusinessPartner $businessPartner)
    {
        abort_if(Gate::denies('business_partner_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.businessPartners.show', compact('businessPartner'));
    }

    public function destroy(BusinessPartner $businessPartner)
    {
        abort_if(Gate::denies('business_partner_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessPartner->delete();

        return back();
    }

    public function massDestroy(MassDestroyBusinessPartnerRequest $request)
    {
        $businessPartners = BusinessPartner::find(request('ids'));

        foreach ($businessPartners as $businessPartner) {
            $businessPartner->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('business_partner_create') && Gate::denies('business_partner_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new BusinessPartner();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
