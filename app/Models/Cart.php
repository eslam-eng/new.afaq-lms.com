<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'total',
        'final_total',
        'coupon',
        'coupon_discount',
        'status',
        'created_by',
        'wallet',
        'wallet_discount'
    ];

    public $with = ['items'];

    public function items()
    {
        return $this->hasMany(CartItem::class)->has('course')->whereNull('payment_provider');
    }

    public function all_items()
    {
        return $this->hasMany(CartItem::class);
    }


    public function check_cart(){
        $cart = Cart::firstOrCreate(['user_id' => auth()->user()->id, 'status' => 0]);
        foreach($cart->items as $item){
            if($item->course->soldOut()){
                $item->removeItem();
                $cart->final_total = $cart->final_total - $item->course->price;
            }
        }
        return $cart;
    }
}
