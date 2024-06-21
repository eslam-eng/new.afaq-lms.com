<?php

namespace App\Listeners;
use App\Models\User;
use App\Notifications\RealTimeNotification;
use Illuminate\Support\Facades\Notification;



class SendNewUserNotification
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $admins = User::whereHas('roles' , function($query){
            $query->where('id',1);
        })->get();
        $user = auth()->user();
        $data =[
            'user_id' => $user->id,
            'message' => 'Hello World! I am a notification 😄',
            'title_en' => 'test',
            'title_ar' => 'تيست',
            'message_en' => 'testt',
            'message_ar' => 'تيستت',
            'type' => 'course',
            'parent_id' => null,
        ];
        Notification::send($admins, new RealTimeNotification($data));
    }
}