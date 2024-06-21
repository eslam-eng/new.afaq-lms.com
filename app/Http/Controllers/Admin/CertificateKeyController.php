<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCertificateKeyRequest;
use App\Http\Requests\StoreCertificateKeyRequest;
use App\Http\Requests\UpdateCertificateKeyRequest;
use App\Models\CertificateKey;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CertificateKeyController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('certificate_key_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $certificateKeys = CertificateKey::all();

        return view('admin.certificateKeys.index', compact('certificateKeys'));
    }

    public function create()
    {
        abort_if(Gate::denies('certificate_key_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.certificateKeys.create');
    }

    public function store(StoreCertificateKeyRequest $request)
    {
        $certificateKey = CertificateKey::create($request->all());

        return redirect()->route('admin.certificate-keys.index');
    }

    public function edit(CertificateKey $certificateKey)
    {
        abort_if(Gate::denies('certificate_key_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.certificateKeys.edit', compact('certificateKey'));
    }

    public function update(UpdateCertificateKeyRequest $request, CertificateKey $certificateKey)
    {
        $certificateKey->update($request->all());

        return redirect()->route('admin.certificate-keys.index');
    }

    public function show(CertificateKey $certificateKey)
    {
        abort_if(Gate::denies('certificate_key_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.certificateKeys.show', compact('certificateKey'));
    }

    public function destroy(CertificateKey $certificateKey)
    {
        abort_if(Gate::denies('certificate_key_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $certificateKey->delete();

        return back()->with('message', __('global.delete_account_success'));
    }

    public function massDestroy(MassDestroyCertificateKeyRequest $request)
    {
        CertificateKey::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function get_type_data()
    {
        $model = request('type');
        if ($model) {
            $object = new $model;
            return $object->getFillable();
        }
        return [];
    }
}
