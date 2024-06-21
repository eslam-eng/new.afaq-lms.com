<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPaymentMethodRequest;
use App\Http\Requests\StorePaymentMethodRequest;
use App\Http\Requests\UpdatePaymentMethodRequest;
use App\Models\PaymentMethod;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PaymentMethodsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('payment_method_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentMethods = PaymentMethod::with(['media'])->orderBy('id', 'desc')->get();

        return view('admin.paymentMethods.index', compact('paymentMethods'));
    }

    public function create()
    {
        abort_if(Gate::denies('payment_method_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.paymentMethods.create');
    }

    public function store(StorePaymentMethodRequest $request)
    {
        $paymentMethod = PaymentMethod::create($request->all());

        if ($request->input('provider_image', false)) {
            $paymentMethod->addMedia(storage_path('tmp/uploads/' . basename($request->input('provider_image'))))->toMediaCollection('provider_image');
        }

        if ($request->input('local_image', false)) {
            $paymentMethod->addMedia(storage_path('tmp/uploads/' . basename($request->input('local_image'))))->toMediaCollection('local_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $paymentMethod->id]);
        }

        return redirect()->route('admin.payment-methods.index');
    }

    public function edit(PaymentMethod $paymentMethod)
    {
        abort_if(Gate::denies('payment_method_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.paymentMethods.edit', compact('paymentMethod'));
    }

    public function update(UpdatePaymentMethodRequest $request, PaymentMethod $paymentMethod)
    {
        //        dd($request->local_image);
        $paymentMethod->update($request->all());

        // if ($request->input('provider_image', false)) {
        //     if (!$paymentMethod->provider_image || $request->input('provider_image') !== $paymentMethod->provider_image->file_name) {
        //         if ($paymentMethod->provider_image) {
        //             $paymentMethod->provider_image->delete();
        //         }
        //         $paymentMethod->addMedia(storage_path('tmp/uploads/' . basename($request->input('provider_image'))))->toMediaCollection('provider_image');
        //     }
        // } elseif ($paymentMethod->provider_image) {
        //     $paymentMethod->provider_image->delete();
        // }

        //        if ($request->input('local_image', false)) {
        //            if (!$paymentMethod->local_image || $request->input('local_image') !== $paymentMethod->local_image->file_name) {
        //                if ($paymentMethod->local_image) {
        //                    $paymentMethod->local_image->delete();
        //                }
        //                $paymentMethod->addMedia(storage_path('tmp/uploads/' . basename($request->input('local_image'))))->toMediaCollection('local_image');
        //
        //            }
        //        } elseif ($paymentMethod->local_image) {
        //            $paymentMethod->local_image->delete();
        //        }
        if ($request->file('local_image', false)) {
            if (!$paymentMethod->local_image || $request->file('local_image') !== $paymentMethod->local_image->file_name) {
                if ($paymentMethod->local_image) {
                    $paymentMethod->local_image->delete();
                }
                $paymentMethod->addMedia($request->file('local_image'))->toMediaCollection('local_image');
            }
        }


        return redirect()->route('admin.payment-methods.index');
    }

    public function show(PaymentMethod $paymentMethod)
    {
        abort_if(Gate::denies('payment_method_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.paymentMethods.show', compact('paymentMethod'));
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        abort_if(Gate::denies('payment_method_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentMethod->delete();

        return back()->with('message', __('global.delete_account_success'));
    }

    public function massDestroy(MassDestroyPaymentMethodRequest $request)
    {
        PaymentMethod::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('payment_method_create') && Gate::denies('payment_method_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PaymentMethod();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function methods_view()
    {
        $methods = PaymentMethod::with(['media'])->orderBy('order','asc')->get();
        return view('admin.paymentMethods.reorder',compact('methods'));
    }
    public function sort_method(Request $request)
    {

        foreach ($request->order as $key => $order) {
            $methods = PaymentMethod::find($order['id'])->update(['order' => $order['order']]);
        }
        return response('Updated Successfully.', 200);
    }
}
