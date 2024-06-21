<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\Notification as FcmNotification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewOrderNotification extends Notification implements ShouldBroadcast
{
    use Queueable;

    public $data;


    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function via($notifiable)
    {
        return [FcmChannel::class,'broadcast'];
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        $message = $this->data['message'];

        return new BroadcastMessage([
            'message' => "$message (Message for $notifiable->name))"
        ]);
    }
    // public function toFcm($notifiable)
    // {
        
    //     return FcmMessage::create()
    //         ->setData([
    //             'title' => 'New Order',
    //             'body' => 'You have received a new order.',
    //         ])
    //         ->setNotification(FcmNotification::create()
    //         ->setTitle('New Order')
    //         ->setBody('You have received a new order.')
    //     );
    // }

    // public function toDatabase($notifiable) { 
    //     return $this->data;
    // }
}
