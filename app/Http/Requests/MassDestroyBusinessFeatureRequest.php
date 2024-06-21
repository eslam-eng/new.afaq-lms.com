<?php

namespace App\Http\Requests;

use App\Models\BusinessFeature;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBusinessFeatureRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('business_feature_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:business_features,id',
        ];
    }
}
