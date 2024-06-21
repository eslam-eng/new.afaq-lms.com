<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JoinUsStoreRequest extends FormRequest
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
            'name_ar' => [
                'string',
                'required',
            ],
            'job_title' => [
                'required',
            ],
            'workplace' => [
                'required', 'string',
            ],
            'specialty_id' => [
                'required',
            ],
            'mail' => [
                'required','email'
            ],
            'twitter_account' => [
                'required', 'url',
            ],
            'mobile' => [
                'required',
            ],
            'resume' => 'required|file|mimes:doc,pdf,docx'//jpeg,png,jpg,gif,svg|max:4096
        ];
    }
}
