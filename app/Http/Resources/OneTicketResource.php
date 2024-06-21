<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OneTicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        $image= {{ asset('storage/ticket-image') }};
        return [
            'id' => $this->id ?? null,
            'title' => $this->title ?? null,
            'description' => $this->description ?? null,
            'status' => $this->status ? 'Resolved' : 'Opened',
            'created_at' => $this->created_at ? date('Y-m-d', strtotime($this->created_at)) : null,
            'image' => $this->image ? asset('storage/'.$this->image) : null,
//            'replies_number' => app()->getLocale() == 'ar' ? 'ردود ' . $this->replies_number  : $this->replies_number . ' Replies',
//            'replies_number' => count($this->replies_number), //$this->count_review ? (int)$this->count_review : 0,
            'ticket_category' => $this->ticket_category ?  new TicketCategoryResource($this->ticket_category) : null
        ];
    }
}
