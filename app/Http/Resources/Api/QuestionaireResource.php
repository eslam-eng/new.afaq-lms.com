<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class QuestionaireResource extends JsonResource
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
            'title' => app()->getLocale() == 'en' ?  $this->title_en : $this->title_ar,
            'questions' => $this->questions ? QuestionaireQuestionsResource::collection($this->questions) : null
        ];
    }
}
