<?php

namespace App\Http\Resources;

use App\Models\Ticket;
use App\Models\TicketCategory;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'description' => $this->description ?? null,
            'status' => $this->statues ? 'Resolved' : 'Opened',
            'image' => $this->image ? asset('storage/'.$this->image) : null,
//            'replies_number' => $this->replies_number->count() ?? null,
            'created_at' => $this->created_at ? date('Y-m-d', strtotime($this->created_at)) : null,
            'ticket_category' => $this->ticket_category ?  new TicketCategoryResource($this->ticket_category) : null
        ];
    }
}
