<?php

namespace App\Http\Resources\Api;

use App\Models\CourseSectionLecture;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseSectionResource extends JsonResource
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
            'id' => $this->id,
            'name' => app()->getLocale() == 'en' ? $this->title_en : $this->title_ar,
            'lectures' => $this->lectures ? CourseSectionLectureResource::collection($this->lectures) : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
