<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OneTicketCommentResource extends JsonResource
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
            'author_name' => $this->author_name ?? null,
            'author_email' => $this->author_email ?? null,
            'replies' => $this->comment_text ?? null,
            'comment_type' => $this->comment_type ?? null,
            'comment_image' => $this->image ? asset('storage/'.$this->image) : null,
            'created_at' => $this->created_at ? date('Y-m-d', strtotime($this->created_at)) : null,
            'ticket' =>  $this->ticket ?  new TicketResource($this->ticket) : null,

        ];
    }
}
