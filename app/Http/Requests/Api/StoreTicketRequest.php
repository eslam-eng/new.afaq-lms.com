<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class StoreTicketRequest extends FormRequest
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
            'title'         => 'required',
            'description'       => 'required',
            'user_id' => 'required|int|exists:users,id',
            'ticket_category_id' => 'required|int|exists:ticket_categories,id',
            'email'  => 'required|email|exists:users,email',
            'image' => 'image|nullable|mimes:jpeg,png,jpg|max:1024',
        ];
    }
    public function attributes()
    {
        return [
            'title' => __('validation.attributes.title'),
            'description' => __('validator.description'),
            'email' => __('validator.email'),
            'ticket_category_id' =>__('validator.ticket_category_id'),
            'user_id' => __('validator.user_id'),
            'image' => __('validator.image'),

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(
            ['errors' => $errors,],JsonResponse::HTTP_UNPROCESSABLE_ENTITY
        ));
    }
}
