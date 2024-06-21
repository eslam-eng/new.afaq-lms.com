<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_create');
    }

    public function rules()
    {
        return [
            'email'    => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('users')->whereNull('deleted_at')
            ],
            'password' => 'required|string|min:6',
            'full_name_en' => ['string', 'min:3', 'max:100', 'required',],
            'full_name_ar' => ['string',  'min:3', 'max:100', 'required',],
            'phone' => ['string', 'required', 'unique:users,phone'],
            'gender' => ['string', 'required',],
            'personal_photo' => ['image', 'mimes:jpg,png,jpeg,gif,svg'],

            'sub_specialty_id' => ['required'],
            'specialty_id' => ['required'],
            'nationality_id' => ['required'],
            'name_title' => ['required'],
            // 'identity_number' => [Rule::requiredIf(request('identity_type') != 'non_resident')],
            // 'identity_type' => ['required', 'in:national_id,resident_id,passport,non_resident'],
            'roles.*'            => [
                'integer',
            ],
            'roles'              => [
                'required',
                'array',
            ],
        ];
    }
}
