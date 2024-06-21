<?php

namespace App\Http\Controllers\Api\V1\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CartItemResource;
use App\Http\Resources\WalletResource;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CouponCode;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\PaymentDetails;
use App\Models\Wallet;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CartApiController extends Controller
{
    public function MyCart()
    {
        try {
            $user = auth()->user();
            $cart = Cart::check_cart();
       
            $this->update_cart_total($cart);
            $items = $cart->items;
            $wallet = Wallet::firstOrCreate(['user_id' => $user->id]);
            $total_price = $cart->final_total;
            

            $course_exclusive = $items->filter(function ($item) {
                return $item->course->has_exclusive_mobile == 1;
            });
            // dd($course_exclusive[0]->course_price);

            $total_exc_price = $course_exclusive->sum(function ($item) {
                return $item->course_price;
            });

            $total_price = $total_price - $total_exc_price;
    
            if($wallet && $cart->wallet){
                $data = [
                    'id' => $wallet->id ?? null,
                    'balance' => $wallet ? get_price($wallet->balance) : get_price(0),
                ];
            }elseif($wallet && !$cart->wallet && $wallet->balance > 0){
                $data = [
                    'id' => $wallet->id ?? null,
                    'balance' => $wallet ? get_price($wallet->balance) : get_price(0),
                ];
            }else{
                $data = null;
            }
            
            // $items = CartItem::has('course')->where('user_id', $user->id)->where('status', 0)->get();
            return $this->toJson([
                'cart_id' => $items->count() > 0 ? $items->first()->cart_id : null,
                'cart_item_count' => $items->count() > 0 ? $items->where('read', 0)->count() : 0,
                'cart_total' => $cart ? get_price($total_price) : null,
                'total_tabby' =>$cart ? $total_price : null,
                'cart_old_total' => $cart ? get_price($cart->total) : null,
                //$wallet && $wallet->balance && cart->wallet 
                'wallet' => $data,
                'use_wallet' => $cart->wallet ? true : false,
                'wallet_discount' => $cart->wallet_discount ? get_price($cart->wallet_discount) : null,
                'items' => $items->count() > 0 ? CartItemResource::collection($items) : null
            ]);
        } catch (\Throwable $th) {
            if (config('app.debug')) {
                //throw $th;
                return $this->toJson(null, 400, $th->getMessage(), false);
            }
        }
    }

    public function Add($course_id)
    {
        try {
            $user = auth()->user();

            $course = Course::find($course_id);
            if (!$course) {
                return $this->toJson(null, 400, 'course not found', false);
            }
            
            if(Enroll::reservation_number($course->id) >= $course->seating_number && !is_null($course->seating_number) && $course->seating_number >0){
                return $this->toJson(null, 400,  __('cruds.course_messages.seats_booked'), false);
            }

            if ($course->today_price == null && strval($course->today_price) == '') {
                return $this->toJson(null, 400, 'Not Available for your specialty', false);
            } else {
                // $this->update_cart_total_for_wallet();
                // $cart = Cart::firstOrCreate(['user_id' => auth()->user()->id, 'status' => 0]);
                // $cart->total = $cart->items->sum('course_price') + $cart->items->sum('coupon_discount');
                // $cart->final_total = $cart->final_total + $cart->wallet_discount;
                // $cart->save();
                $cart = Cart::firstOrCreate(['user_id' => $user->id, 'status' => 0]);
                $data['course_id'] = $course_id;
                $data['cart_id'] = $cart->id;
                $data['course_price'] = $course->today_price ?? $course->price ?? 0;
                $data['user_id'] = $user->id;
                CartItem::firstOrCreate($data);
            }

            try {

                Wishlist::where(['course_id' => $course_id, 'user_id' => $user->id])->delete();

                SendNotification([
                    'title_en' => __('notification.add_cart_title', [], 'en'),
                    'message_en' => __('notification.add_cart_message', [], 'en'),
                    'title_ar' => __('notification.add_cart_title', [], 'ar'),
                    'message_ar' => __('notification.add_cart_message', [], 'ar')
                ],null,null,$cart->id,'user_cart');
            } catch (\Throwable $th) {
                //throw $th;
            }

            return $this->MyCart();
        } catch (\Throwable $th) {
            if (config('app.debug')) {
                //throw $th;
                return $this->toJson(null, 400, $th->getMessage(), false);
            }
        }
    }

    public function Remove($course_id)
    {
        try {
            DB::beginTransaction();

            $user = auth()->user();          
            $this->update_cart_total_for_wallet();
            $cart = Cart::firstOrCreate(['user_id' => $user->id, 'status' => 0]);
            


            CartItem::where([
                'course_id' => $course_id,
                'cart_id' => $cart->id,
                'user_id' => $user->id
            ])->delete();

            $p_details = PaymentDetails::where([
                'course_id' => $course_id,
                'status' => 0,
                'user_id' => $user->id
            ])->first();

            if ($p_details) {
                $p_details->enrolls()->delete();
                $p_details->payments()->delete();
                $p_details->delete();
            }

            DB::commit();

            return $this->MyCart();
        } catch (\Throwable $th) {
            if (config('app.debug')) {
                //throw $th;
                return $this->toJson(null, 400, $th->getMessage(), false);
            }
        }
    }

    public function CouponAdd(Request $request)
    {
        $v =  Validator::make($request->all(), [
            'coupon_text' => 'required',
            'item_id' => 'nullable|exists:cart_items,id'
        ]);

        if ($v->fails()) {
            return $this->toJson(null, 400, $v->messages()->first(), false);
        }

        $user = auth()->user();
        $item = CartItem::find($request->item_id);

        if ($item->coupon) {

            return $this->toJson(null, 422, 'You already use coupon', false);
        }

        $coupon = CouponCode::whereCouponText($request->coupon_text)->whereHas('courses', function ($courses) use ($item) {
            $courses->where('course_id', $item->course_id);
        })->where('coupon_expire_date', '>', date('Y-m-d', strtotime(now())))->first();

        $coupon_used_number =Enroll::where('coupon',$request->coupon_text)->count();

        if (!$coupon) {
            return $this->toJson(null, 422, 'Coupon is not available', false);
        }

        if ($coupon && $coupon_used_number < $coupon->coupon_use_number) {
            $discount = ($coupon->coupon_type == "percentage") ? (($item->course_price * $coupon->coupon_amount) / 100) : $coupon->coupon_amount;
            $item->coupon = $request->coupon_text;
            $item->coupon_discount = $discount;
            $item->course_price = ($discount > $item->course_price) ? 0 : $item->course_price - $discount;
            $item->update();
        }else{
            return $this->toJson(null, 422, 'Coupon is Expired', false);
        }

        try {
            $this->save_log(auth()->user()->id, "The user: " . auth()->user()->name . " use " . $item->coupon . " coupon.");
        } catch (\Throwable $th) {
            //throw $th;
        }

        return $this->MyCart();
    }

    public function CouponRemove(Request $request)
    {
        $v =  Validator::make($request->all(), [
            'item_id' => 'nullable|exists:cart_items,id'
        ]);

        if ($v->fails()) {
            return $this->toJson(null, 400, $v->messages()->first(), false);
        }

        $item = CartItem::find($request->item_id);
        $item->course_price = $item->coupon_discount + $item->course_price;
        $item->coupon = null;
        $item->coupon_discount = null;
        $item->update();

        try {
            $this->save_log(auth()->user()->id, "The user: " . auth()->user()->name . " remove " . $item->coupon . " coupon.");
        } catch (\Throwable $th) {
            //throw $th;
        }

        return $this->MyCart();
    }

    public function update_cart_total($cart)
    {
        if ($cart) {
            $total = 0;
            $final = 0;
            $coupon_discount = 0;
            $coupon = null;

            foreach ($cart->items as $item) {

                if ($item->course) {

                    if ($item->coupon) {
                        $coupon = CouponCode::where('coupon_text', $item->coupon)->first();
                        $enroll_count = Enroll::where('coupon', $item->coupon)->count();

                        if ($coupon && $enroll_count == $coupon->coupon_use_number) {
                            $total += (float)$item->course->today_price;
                            $final += (float)$item->course->today_price;
                            $coupon = null;
                            $item->update([
                                'course_price' => $item->course->today_price,
                                'coupon' => null,
                                'coupon_discount' => null
                            ]);
                        } else {
                            if($item->coupon){
                                $item->update(['course_price' => $item->course->today_price - $item->coupon_discount]);
                                $total += (float)$item->course->today_price;
                                $final += (float)$item->course->today_price - $item->coupon_discount;
                                $coupon_discount += $item->coupon_discount;
                                $coupon = $item->coupon;
                            }
                        }
                    }else{
                        $item->update(['course_price' => $item->course->today_price]);
                        $total += (float)$item->course->today_price;
                        $final += (float)$item->course->today_price;
                    }

                    if (strtotime($item->course->end_register_date) < strtotime(now())) {
                        $item->delete();
                    }
                } else {
                    $item->delete();
                }
            }

            if($cart->wallet){
                $final = $final - $cart->wallet_discount;
            }

            $cart->update(['coupon_discount' => $coupon_discount, 'total' => $total, 'final_total' => $final, 'coupon' => $coupon]);
        }
    }

    public function update_cart_total_for_wallet()
    {
        $cart = Cart::firstOrCreate(['user_id' => auth()->user()->id, 'status' => 0]);
        if($cart->wallet){
            $wallet = Wallet::where('user_id' , auth()->user()->id)->first();
            $wallet->update(['balance' => $wallet->balance + $cart->wallet_discount]);
        }
        $cart->total = $cart->items->sum('course_price') + $cart->items->sum('coupon_discount');
        $cart->final_total = $cart->final_total + $cart->wallet_discount;
        $cart->wallet = 0;
        $cart->wallet_discount = null;
        $cart->save();
    }
}
