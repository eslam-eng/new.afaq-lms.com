<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBusinessPackageRequest;
use App\Http\Requests\StoreBusinessPackageRequest;
use App\Http\Requests\UpdateBusinessPackageRequest;
use App\Models\BusinessPackage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BusinessPackagesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('business_package_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessPackages = BusinessPackage::all();

        return view('admin.businessPackages.index', compact('businessPackages'));
    }

    public function create()
    {
        abort_if(Gate::denies('business_package_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.businessPackages.create');
    }

    public function store(StoreBusinessPackageRequest $request)
    {
        $businessPackage = BusinessPackage::create($request->all());

        return redirect()->route('admin.business-packages.index');
    }

    public function edit(BusinessPackage $businessPackage)
    {
        abort_if(Gate::denies('business_package_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.businessPackages.edit', compact('businessPackage'));
    }

    public function update(UpdateBusinessPackageRequest $request, BusinessPackage $businessPackage)
    {
        $businessPackage->update($request->all());

        return redirect()->route('admin.business-packages.index');
    }

    public function show(BusinessPackage $businessPackage)
    {
        abort_if(Gate::denies('business_package_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.businessPackages.show', compact('businessPackage'));
    }

    public function destroy(BusinessPackage $businessPackage)
    {
        abort_if(Gate::denies('business_package_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessPackage->delete();

        return back();
    }

    public function massDestroy(MassDestroyBusinessPackageRequest $request)
    {
        $businessPackages = BusinessPackage::find(request('ids'));

        foreach ($businessPackages as $businessPackage) {
            $businessPackage->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
