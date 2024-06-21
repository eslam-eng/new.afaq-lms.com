<?php

namespace App\Http\Requests;

use App\Models\Enquiry;
use App\Rules\Recaptcha;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEnquiryRequest extends FormRequest
{
    public function authorize()
    {
        // return Gate::allows('enquiry_create');
        return true;
    }

    public function rules()
    {
        return [
          //  'g-recaptcha-response' => ['required', new Recaptcha()],
        ];
    }
}
