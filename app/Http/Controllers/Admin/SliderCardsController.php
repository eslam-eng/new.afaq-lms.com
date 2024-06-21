<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySliderCardRequest;
use App\Http\Requests\StoreSliderCardRequest;
use App\Http\Requests\UpdateSliderCardRequest;
use App\Models\SliderCard;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SliderCardsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('slider_card_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sliderCards = SliderCard::with(['media'])->get();

        return view('admin.sliderCards.index', compact('sliderCards'));
    }

    public function create()
    {
        abort_if(Gate::denies('slider_card_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sliderCards.create');
    }

    public function store(StoreSliderCardRequest $request)
    {
        $sliderCard = SliderCard::create($request->all());

        if ($request->input('image', false)) {
            $sliderCard->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $sliderCard->id]);
        }

        return redirect()->route('admin.slider-cards.index');
    }

    public function edit(SliderCard $sliderCard)
    {
        abort_if(Gate::denies('slider_card_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sliderCards.edit', compact('sliderCard'));
    }

    public function update(UpdateSliderCardRequest $request, SliderCard $sliderCard)
    {
        $sliderCard->update($request->all());

        if ($request->input('image', false)) {
            if (!$sliderCard->image || $request->input('image') !== $sliderCard->image->file_name) {
                if ($sliderCard->image) {
                    $sliderCard->image->delete();
                }
                $sliderCard->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($sliderCard->image) {
            $sliderCard->image->delete();
        }

        return redirect()->route('admin.slider-cards.index');
    }

    public function show(SliderCard $sliderCard)
    {
        abort_if(Gate::denies('slider_card_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sliderCards.show', compact('sliderCard'));
    }

    public function destroy(SliderCard $sliderCard)
    {
        abort_if(Gate::denies('slider_card_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sliderCard->delete();

        return back()->with('message', __('global.delete_account_success'));
    }

    public function massDestroy(MassDestroySliderCardRequest $request)
    {
        SliderCard::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('slider_card_create') && Gate::denies('slider_card_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SliderCard();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
