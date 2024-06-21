<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $lang = app()->getLocale();

        return [
            'id' => $this->id ?? null,
            'title' => $this->title ?? null,
            'description' => $this->description ?? null,
            'link' => $this->link ?? null,
            'image' => $this->mobile_img ?? $this->img ?? null,
            'type' =>  $this->type ?? $this->type ?? null,
            'search_id' =>  $this->type_id_for_search ?? $this->type_id_for_search ?? null,
            'course_id' =>  $this->course_id ?? $this->course_id ?? null,
        ];
    }
}
