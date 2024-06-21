<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\FaqResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FaqCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? null,
            'category' => $this->category ?? null,
            'faq_questions' => $this->faqQuestions ? FaqResource::collection($this->faqQuestions) : null
        ];
    }
}
