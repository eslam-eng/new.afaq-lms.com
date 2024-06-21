<?php

namespace App\Interfaces;

interface WishlistRepositoryInterface 
{
    public function getAllWishlist();
    public function createWishlist(array $wishlistDetails);
    public function rmFromWishlist($wishlistId);

    
}