<?php

namespace App\Http\Resources;

use App\Models\FaqCategory;
use Illuminate\Http\Resources\Json\JsonResource;

class PointResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $faq = FaqCategory::with('faqQuestions')->where('type', 'point')->orWhere('category_en', 'like', '%point%')->first();

        return [
            'id' => $this->id ?? null,
            'points' => $this->points ? $this->points .' '. trans('cruds.point.title')  : 0 .' '. trans('cruds.point.title'),
            'invite_code' => $this->invite_code ? (string) $this->invite_code : null,
            'use_code' => $this->use_code ? true : false,
            'used_code' => $this->used_code ? (string)$this->used_code : null,
            'currency' => $this->currency ? (string) $this->currency : 'SAR',
            'status' => $this->status ? true : false,
            'faqs' => $faq ? FaqResource::collection($faq->faqQuestions) : null,
            'can_exchange' => $this->points >= config('app.minimum_point_to_money')  ? true : false,
            'total_exchange' => ($this->points / config('app.point_to_money')) .' '. trans('global.SAR'),
            'min_exchange_points' =>  config('app.minimum_point_to_money')
        ];
    }
}
