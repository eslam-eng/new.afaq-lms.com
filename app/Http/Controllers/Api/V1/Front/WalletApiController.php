<?php

namespace App\Http\Controllers\Api\V1\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CartItemResource;
use App\Http\Resources\WalletResource;
use App\Models\Cart;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WalletApiController extends Controller
{
    public function MyWallet()
    {
        $user = auth()->user();
        $wallet = Wallet::firstOrCreate(['user_id' => $user->id]);
        $data = new WalletResource($wallet);
        return $this->toJson($data);
    }

    public function UseWallet()
    {
        
        try {
            $user = auth()->user();
            $wallet = Wallet::firstOrCreate(['user_id' => $user->id]);
           

            

            $cart = Cart::firstOrCreate(['user_id' => $user->id, 'status' => 0]);
            if ((!$wallet || $wallet->balance < 1 || !$wallet->status) && !$cart->wallet) {
                return $this->toJson(null, 400, 'this user wallet balance not available.', false);
            }

            if ($cart->items->count() < 1) {
                return $this->toJson(null, 400, 'there is no items in cart.', false);
            }

            if ($cart->wallet == 0 && request('use_wallet') == 1) {
                
                if ($cart->final_total > $wallet->balance) {
                    $final_total = $cart->final_total - $wallet->balance;
                    $wallet_discount = $wallet->balance;
                    $wallet_balance = 0;
                } else {
                    $final_total = 0;
                    $wallet_discount = $cart->final_total;
                    $wallet_balance = $wallet->balance - $cart->final_total;
                }

                $data['wallet'] = true;
                $data['final_total'] = $final_total;
                $data['wallet_discount'] = $wallet_discount;
                $data['balance'] = $wallet_balance;
                $cart->update($data);
                $wallet->update(['balance' => $wallet_balance]);
            } elseif ($cart->wallet == 1 && request('use_wallet') == 0) {
                $final_total = $cart->final_total + $cart->wallet_discount;
                $wallet_discount = null;
                $wallet_balance = $wallet->balance  + $cart->wallet_discount;
                

                $data['wallet'] = false;
                $data['final_total'] = $final_total;
                $data['wallet_discount'] = $wallet_discount;
                $cart->update($data);
                $wallet->update(['balance' => $wallet_balance]);
                

            }else{

                $cart = Cart::firstOrCreate(['user_id' => $user->id, 'status' => 0]);
            }
            
            // try {

            //     SendNotification([
            //         'title_en' => __('notification.add_cart_title', [], 'en'),
            //         'message_en' => __('notification.add_cart_message', [], 'en'),
            //         'title_ar' => __('notification.add_cart_title', [], 'ar'),
            //         'message_ar' => __('notification.add_cart_message', [], 'ar')
            //     ]);

            //     $this->save_log(auth()->user()->id, "The user: " . auth()->user()->name . " use " . $wallet_discount . " from his wallet.");
            // } catch (\Throwable $th) {
            //     //throw $th;
            // }
            

            return $this->toJson([
                'cart_id' => $cart->items->count() > 0 ? $cart->items->first()->cart_id : null,
                'cart_item_count' => $cart->items->count() > 0 ? $cart->items->where('read', 0)->count() : 0,
                'cart_total' => $cart ? get_price($cart->final_total) : null,
                'cart_old_total' => $cart ? get_price($cart->total) : null,
                'wallet' => $wallet ? [
                    'id' => $wallet->id ?? null,
                    'balance' => $wallet ? get_price($wallet->balance) : get_price(0),
                ] : null,
                'use_wallet' => $cart->wallet ? true : false,
                'wallet_discount' => $cart->wallet_discount ? get_price($cart->wallet_discount) : null,
                'items' => $cart->items->count() > 0 ? CartItemResource::collection($cart->items) : null
            ]);
        } catch (\Throwable $th) {
            if (config('app.debug')) {
                //throw $th;
                return $this->toJson(null, 400, $th->getMessage(), false);
            }
        }
    }
}
