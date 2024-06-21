<?php

namespace App\Jobs;

use App\Models\CartItem;
use App\Models\Course;
use App\Models\Enroll;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateCartJob implements ShouldQueue
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
        $courses = Course::whereDate('end_register_date', '<', date('Y-m-d', strtotime(now())))->pluck('id')->toArray();
        if (count($courses)) {
            $cart_items = CartItem::whereIn('course_id', $courses)->get();
            foreach ($cart_items as $cart_item) {
                if (!Enroll::where('course_id', $cart_item->course_id)->where('user_id', $cart_item->user_id)->where('approved', 1)->exists()) {
                    $cart_item->forceDelete();
                }
            }
        }
    }
}
