<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\ReviewResource;
use App\Models\Wishlist;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class SearchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $member_ship = auth()->check() ? auth()->user()->active_membership : null;
        if($this->has_exclusive_mobile === 1){
            $price =__('home.free');
        }else{
            // dd('dd');
            $price =  $this->today_price ? get_price($this->today_price) : ($this->prices->count() ? trans('afaq.different_prices') : __('home.free'));
        }

        // dd($price);

        return [
            'id' => $this->id ?? null,
            'name' => $this->name ?? null,
            'has_exclusive_mobile' => $this->has_exclusive_mobile,
            'description' => $this->description ? Str::limit(strip_tags($this->description), 200) : null,
            'price' => $price,
            'old_price' => $member_ship ? ($this->price ? get_price($this->price) : null) : null,
            'image' => $this->image ? get_image($this->image->url) : null,
            'sponsor_img' => $this->sponsors->first() ? get_image($this->sponsors->first()->image_url) : null,
            'sponsor_img_object' => $this->when($this->accreditation_number && $this->accredit_hours && ($this->course_accreditation_id == 12), [
                'accreditation_number' => $this->accreditation_number ?? null,
                'accredit_hours' => $this->accredit_hours ?? null,
            ]),
            'under_accredit' => $this->when($this->course_accreditation_id == 14,$this->courseAccreditation->image_url),

            'place_img' => $this->coursePlace ? get_image($this->coursePlace->image_url) : null,
            'start_register_date' => $this->start_register_date ? date('Y-m-d', strtotime($this->start_register_date)) : null,
            'course_track' => $this->courseTrack ? $this->courseTrack->title : null,
            'start_date' => $this->start_date ? date('Y-m-d', strtotime($this->start_date)) : null,
            'rating' => $this->rate,
            'reviews' => $this->reviews()->count(),
            'in_wishlist' => $this->in_wishlist,
            'in_cart' => $this->in_cart

        ];
    }
}
