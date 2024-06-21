<?php

namespace App\Observers;

use App\Models\Point;
use App\Notifications\RealTimeNotification;

class PointObserver
{
    /**
     * Handle the Point "created" event.
     *
     * @param  \App\Models\Point  $point
     * @return void
     */
    public function created(Point $point)
    {
        $user = auth()->user();
        $notificationData = [
            'message' => 'New point created',
            'title_en' => 'New point created',
            'title_ar' => 'New point created',
            'message_en' => 'A new point has been created',
            'message_ar' => 'تم إنشاء point جديد',
            'type' => 'user',
            'parent_id' => null,
        ];

        $user->notify(new RealTimeNotification($notificationData));
    }

    /**
     * Handle the Point "updated" event.
     *
     * @param  \App\Models\Point  $point
     * @return void
     */
    public function updated(Point $point)
    {
        //
    }

    /**
     * Handle the Point "deleted" event.
     *
     * @param  \App\Models\Point  $point
     * @return void
     */
    public function deleted(Point $point)
    {
        //
    }

    /**
     * Handle the Point "restored" event.
     *
     * @param  \App\Models\Point  $point
     * @return void
     */
    public function restored(Point $point)
    {
        //
    }

    /**
     * Handle the Point "force deleted" event.
     *
     * @param  \App\Models\Point  $point
     * @return void
     */
    public function forceDeleted(Point $point)
    {
        //
    }
}
