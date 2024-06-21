<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Interfaces\WishlistRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;




class WishlistController extends Controller
{
    private $wishlistRepository;

    public function __construct(WishlistRepositoryInterface $wishlistRepository)
    {
        $this->wishlistRepository = $wishlistRepository;
    }

    public function index()
    {
        $wishlist =$this->wishlistRepository->getAllWishlist();
        return view('frontend.afaq_wishlist')->with('wishlist', $wishlist);
    }

    public function addCourseToWishList(Request $request){
        return $this->wishlistRepository->createWishlist([
            'course_id' => $request->input('course_id'),
            'user_id' =>auth()->user()->id
        ]);
    }


    public function removeCourseFromWishList(Request $request){
        $course_in_wishlist =Wishlist::where([
            'course_id' => $request->input('course_id'),
            'user_id' =>auth()->user()->id
        ])->first();
        return $this->wishlistRepository->rmFromWishlist($course_in_wishlist->id);
    }



}
