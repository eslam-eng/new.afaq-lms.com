<?php

namespace App\Jobs;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CouponCode;
use App\Models\Enroll;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CouponControlJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $coupons = CouponCode::whereDate('coupon_expire_date', '>', date('Y-m-d', strtotime(now())))->get();

        if (count($coupons)) {
            foreach ($coupons as $coupon) {
                $coupon_used_number = Enroll::where('coupon', $coupon->coupon_text)->count();
                if ($coupon_used_number  == $coupon->coupon_use_number) {
                    $cart_items = CartItem::where('coupon', $coupon->coupon_text)->whereNull('invoice_id')->get();
                    foreach ($cart_items as $cart_item) {
                        if (!Enroll::where('course_id', $cart_item->course_id)->where('user_id', $cart_item->user_id)->where('approved', 1)->exists()) {
                            $cart_item->update([
                                'coupon' => null,
                                'coupon_discount' => null,
                                'course_price' => $cart_item->course_price + $cart_item->discount
                            ]);
                            $cart = Cart::find($cart_item->cart_id);
                            $cart->update([
                                'coupon_discount' => null,
                                'total' => $cart->total + $cart_item->discount,
                                'final_total' => $cart->final + $cart_item->discount,
                                'coupon' => null
                            ]);
                        }
                    }
                }
            }
        }
    }
}
