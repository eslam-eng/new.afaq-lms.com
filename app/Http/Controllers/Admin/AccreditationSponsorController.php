<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAccreditationSponsorRequest;
use App\Http\Requests\StoreAccreditationSponsorRequest;
use App\Http\Requests\UpdateAccreditationSponsorRequest;
use App\Models\AccreditationSponsor;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class AccreditationSponsorController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('accreditation_sponsor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accreditationSponsors = AccreditationSponsor::with(['media'])->get();

        return view('admin.accreditationSponsors.index', compact('accreditationSponsors'));
    }

    public function create()
    {
        abort_if(Gate::denies('accreditation_sponsor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.accreditationSponsors.create');
    }

    public function store(StoreAccreditationSponsorRequest $request)
    {
        $accreditationSponsor = AccreditationSponsor::create($request->all());

        if ($request->input('logo', false)) {
            $accreditationSponsor->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $accreditationSponsor->id]);
        }

        return redirect()->route('admin.accreditation-sponsors.index');
    }

    public function edit(AccreditationSponsor $accreditationSponsor)
    {
        abort_if(Gate::denies('accreditation_sponsor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.accreditationSponsors.edit', compact('accreditationSponsor'));
    }

    public function update(UpdateAccreditationSponsorRequest $request, AccreditationSponsor $accreditationSponsor)
    {
        $accreditationSponsor->update($request->all());

        if ($request->input('logo', false)) {
            if (!$accreditationSponsor->logo || $request->input('logo') !== $accreditationSponsor->logo->file_name) {
                if ($accreditationSponsor->logo) {
                    $accreditationSponsor->logo->delete();
                }
                $accreditationSponsor->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
            }
        } elseif ($accreditationSponsor->logo) {
            $accreditationSponsor->logo->delete();
        }

        return redirect()->route('admin.accreditation-sponsors.index');
    }

    public function show(AccreditationSponsor $accreditationSponsor)
    {
        abort_if(Gate::denies('accreditation_sponsor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.accreditationSponsors.show', compact('accreditationSponsor'));
    }

    public function destroy(AccreditationSponsor $accreditationSponsor)
    {
        abort_if(Gate::denies('accreditation_sponsor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accreditationSponsor->delete();

        return back()->with('message', __('global.delete_account_success'));
    }

    public function massDestroy(MassDestroyAccreditationSponsorRequest $request)
    {
        AccreditationSponsor::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('accreditation_sponsor_create') && Gate::denies('accreditation_sponsor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new AccreditationSponsor();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
