<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'title' => $this->title ?? null,
            'message' => $this->message ?? null,
            'item_id' => $this->item_id,
            'action_type' => $this->action,
            'read' => $this->read ? true : false,
            'created_at' => $this->created_at ? $this->created_at->diffForHumans() : null
        ];
    }
}
