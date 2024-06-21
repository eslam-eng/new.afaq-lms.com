<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class RegisterSpecialtiesResource extends JsonResource
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
            'name' => $this->name,
            'sub_specialties' => !empty($this->subcategories) ? RegisterSpecialtiesResource::collection($this->subcategories) : null,
            'scfhs' => (bool) !in_array($this->id, [9, 10])
        ];
    }
}
