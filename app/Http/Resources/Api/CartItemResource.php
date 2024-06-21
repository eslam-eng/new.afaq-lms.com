<?php

namespace App\Http\Resources\Api;

use App\Models\Wishlist;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($this->course->has_exclusive_mobile === 1){
            $price =__('home.free');
        }else{
            $price =  $this->course_price ? get_price($this->course_price) :  __('home.free');
        }

        
        return [
            'id' => $this->course->id ?? null,
            'item_id' => $this->id ?? null,
            'name' => $this->course->name ?? null,
            'price' => $price,
            'old_price' => $this->coupon_discount  ? get_price($this->course_price  + $this->coupon_discount)  : null,
            'image' => $this->course->image ? get_image($this->course->image->url) : null,
            'rating' => $this->course->rate,
            'reviews' => $this->course->reviews()->count() > 0 ? $this->course->reviews()->count() : null,
            'coupon_available' => $this->course_price > 0 && !$this->coupon ? true : false,
            'coupon' => $this->coupon ?? null,
            'coupon_discount' => $this->coupon_discount ? get_price($this->coupon_discount) : null,
            'in_wishlist' => $this->course->in_wishlist,
            'in_cart' => $this->course->in_cart,
            'is_free' => $this->course_price ? 0 : 1
        ];
    }
}
