<?php

namespace App\Http\Resources\Api;

use App\Models\Wishlist;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class LectureNoteResource extends JsonResource
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
            'id' => $this->id ,
            'note' => $this->note,
            'in_time' => $this->in_time
        ];
    }
}
