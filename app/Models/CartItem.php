<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $table = 'cart_items';
    protected $fillable = [
        'course_id',
        'user_id',
        'cart_id',
        'course_price',
        'status',
        'coupon',
        'coupon_discount',
        'payment_provider',
        'invoice_id'
    ];

    public $with = ['course'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function removeItem(){
        $this->delete();
    }
}
