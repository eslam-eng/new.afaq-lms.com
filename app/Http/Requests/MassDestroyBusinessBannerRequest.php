<?php

namespace App\Http\Requests;

use App\Models\BusinessBanner;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBusinessBannerRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('business_banner_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:business_banners,id',
        ];
    }
}
