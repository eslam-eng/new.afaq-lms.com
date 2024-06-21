<?php

namespace App\Http\Requests\Courses\Prices;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'data.*.early_price'=> "required|numeric",
            'data.*.late_price'=> "required|numeric",
            'data.*.course_id'=> "required|numeric|exists:courses,id",
            'data.*.specialty_id'=> "required|exists:specialties,id",

        ];
    }


}
