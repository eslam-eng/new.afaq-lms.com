<?php

namespace App\Repositories;

use App\Interfaces\WishlistRepositoryInterface;
use App\Models\Wishlist;

class WishlistRepository implements WishlistRepositoryInterface 
{
    public function getAllWishlist() 
    {
        return Wishlist::where('user_id' ,auth()->user()->id)->get();
    }


    public function createWishlist(array $wishlistDetails){
        return Wishlist::updateOrCreate($wishlistDetails);  
    }

    public function rmFromWishlist($wishlistId) 
    {
        Wishlist::destroy($wishlistId);
    }

    // public function getOrderById($orderId) 
    // {
    //     return Order::findOrFail($orderId);
    // }

    // public function deleteOrder($orderId) 
    // {
    //     Order::destroy($orderId);
    // }

    // public function createOrder(array $orderDetails) 
    // {
    //     return Order::create($orderDetails);
    // }

    // public function updateOrder($orderId, array $newDetails) 
    // {
    //     return Order::whereId($orderId)->update($newDetails);
    // }

    // public function getFulfilledOrders() 
    // {
    //     return Order::where('is_fulfilled', true);
    // }
}