<?php

namespace App\Http\Resources;

use App\Models\FaqCategory;
use Illuminate\Http\Resources\Json\JsonResource;

class WalletResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *

     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $faq = FaqCategory::with('faqQuestions')->where('type', 'wallet')->orWhere('category_en', 'like', '%wallet%')->first();

        return [
            'id' => $this->id ?? null,
            'balance' => $this->balance ? (string) $this->balance . ' ' . $this->currency : '0 SAR',
            'status' => $this->status ? true : false,
            'faqs' => $faq ? FaqResource::collection($faq->faqQuestions) : null
        ];
    }
}
