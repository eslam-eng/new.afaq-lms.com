<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CoursePriceResource extends JsonResource
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
            "id" => $this->id,
            "early_price" => $this->early_price.' ' . __('home.curruncy'),
            "late_price" => $this->late_price.' ' . __('home.curruncy'),
            "specialty" => $this->specialty ? $this->specialty->name : null,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
