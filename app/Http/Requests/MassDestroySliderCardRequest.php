<?php

namespace App\Http\Requests;

use App\Models\SliderCard;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySliderCardRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('slider_card_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:slider_cards,id',
        ];
    }
}
