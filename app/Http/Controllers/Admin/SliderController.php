<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySliderRequest;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Models\Slider;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SliderController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('slider_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sliders = Slider::with(['media'])->get();

        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        abort_if(Gate::denies('slider_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = \App\Models\Course::getAllCoursesNames();
        $quickAccess = \App\Models\Lookup::getQuickAccess();

        return view('admin.sliders.create' , compact('courses','quickAccess'));
    }

    public function store(StoreSliderRequest $request)
    {
        // $data = $request->all();
       
        $url =  config('app.APP_URL');
        if( $request->input('type') == 'course' && $request->has('course_id')){      
            $linkEn = $url . "/en/one-courses-new/" . $request->input('course_id');
            $linkAr = $url . "/ar/one-courses-new/" . $request->input('course_id');
            $request->merge(['link_en' => $linkEn , 'link_ar' => $linkAr]);

        }elseif( $request->input('type') == 'search' && $request->has('type_id_for_search') ){
            $linkEn = $url . "/ar/all-courses?type_id[]=". $request->input('type_id_for_search');
            $linkAr = $url . "/ar/all-courses?type_id[]=". $request->input('type_id_for_search');
            $request->merge(['link_en' => $linkEn , 'link_ar' => $linkAr]);

        }else{
            dd( $request->all());
        }

        
        
        $slider = Slider::create($request->all());

        if ($request->input('image', false)) {
            $slider->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }
        if ($request->input('image_ar', false)) {
            $slider->addMedia(storage_path('tmp/uploads/' . basename($request->input('image_ar'))))->toMediaCollection('image_ar');
        }
        if ($request->input('mobile_image_en', false)) {
            $slider->addMedia(storage_path('tmp/uploads/' . basename($request->input('mobile_image_en'))))->toMediaCollection('mobile_image_en');
        }

        if ($request->input('mobile_image_ar', false)) {
            $slider->addMedia(storage_path('tmp/uploads/' . basename($request->input('mobile_image_ar'))))->toMediaCollection('mobile_image_ar');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $slider->id]);
        }

        return redirect()->route('admin.sliders.index');
    }

    public function edit(Slider $slider)
    {
        abort_if(Gate::denies('slider_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = \App\Models\Course::getAllCoursesNames();
        $quickAccess = \App\Models\Lookup::getQuickAccess();

        return view('admin.sliders.edit' , compact('slider','courses','quickAccess'));
    }

    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        $url =  config('app.APP_URL');
        if( $request->input('type') == 'course' && $request->has('course_id')){      
            $linkEn = $url . "/en/one-courses-new/" . $request->input('course_id');
            $linkAr = $url . "/ar/one-courses-new/" . $request->input('course_id');
            $request->merge(['link_en' => $linkEn , 'link_ar' => $linkAr]);

        }elseif( $request->input('type') == 'search' && $request->has('type_id_for_search') ){
            $linkEn = $url . "/ar/all-courses?type_id[]=". $request->input('type_id_for_search');
            $linkAr = $url . "/ar/all-courses?type_id[]=". $request->input('type_id_for_search');
            $request->merge(['link_en' => $linkEn , 'link_ar' => $linkAr]);

        }else{
            dd($request->all());
        }
        $slider->update($request->all());

        if ($request->input('image', false)) {
            if (!$slider->image || $request->input('image') !== $slider->image->file_name) {
                if ($slider->image) {
                    $slider->image->delete();
                }
                $slider->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($slider->image) {
            $slider->image->delete();
        }

        if ($request->input('image_ar', false)) {
            if (!$slider->image_ar || $request->input('image_ar') !== $slider->image_ar->file_name) {
                if ($slider->image_ar) {
                    $slider->image_ar->delete();
                }
                $slider->addMedia(storage_path('tmp/uploads/' . basename($request->input('image_ar'))))->toMediaCollection('image_ar');
            }
        } elseif ($slider->image_ar) {
            $slider->image_ar->delete();
        }
        if ($request->input('mobile_image_en', false)) {
            if (!$slider->mobile_image_en || $request->input('mobile_image_en') !== $slider->mobile_image_en->file_name) {
                if ($slider->mobile_image_en) {
                    $slider->mobile_image_en->delete();
                }
                $slider->addMedia(storage_path('tmp/uploads/' . basename($request->input('mobile_image_en'))))->toMediaCollection('mobile_image_en');
            }
        } elseif ($slider->mobile_image_en) {
            $slider->mobile_image_en->delete();
        }

        if ($request->input('mobile_image_ar', false)) {
            if (!$slider->mobile_image_ar || $request->input('mobile_image_ar') !== $slider->mobile_image_ar->file_name) {
                if ($slider->mobile_image_ar) {
                    $slider->mobile_image_ar->delete();
                }
                $slider->addMedia(storage_path('tmp/uploads/' . basename($request->input('mobile_image_ar'))))->toMediaCollection('mobile_image_ar');
            }
        } elseif ($slider->mobile_image_ar) {
            $slider->mobile_image_ar->delete();
        }

        

        return redirect()->route('admin.sliders.index');
    }

    public function show(Slider $slider)
    {
        abort_if(Gate::denies('slider_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sliders.show', compact('slider'));
    }

    public function destroy(Slider $slider)
    {
        abort_if(Gate::denies('slider_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $slider->delete();

        return back()->with('message', __('global.delete_account_success'));
    }

    public function massDestroy(MassDestroySliderRequest $request)
    {
        Slider::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('slider_create') && Gate::denies('slider_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Slider();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function slidersView()
    {
        $sliders = Slider::with(['media'])->orderBy('order','asc')->get();
        return view('admin.sliders.reorder',compact('sliders'));
    }
    public function sortSliders(Request $request)

    {
     foreach ($request->order as $key => $order) {
         $sliders = Slider::find($order['id'])->update(['order' => $order['order']]);
     }
     return response('Update Successfully.', 200);
 }
}
