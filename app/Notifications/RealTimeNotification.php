<?php

namespace App\Notifications;

use App\Models\UserNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Notifications\Events\BroadcastNotificationCreated;

class RealTimeNotification extends Notification implements ShouldBroadcast
{
    use Queueable;

    /**
     * Summary of message
     * @var 
     */
    public $data;


    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function via($notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        $message = $this->data['message'];
        $this->data['message']  = "$message (Message for $notifiable->email)";
    
        $broadcastMessage = new BroadcastMessage($this->data);
    
        // $broadcastMessage->channel = 'popup-real-channel';
        $broadcastMessage->event = 'user-notify';
    
        return $broadcastMessage;
        
    }

    public function broadcastOn()
    {
        
        return new Channel('popup-real-channel');
    }

    // public function broadcastAs()
    // {
    //     return 'user-notify';
    // }


    public function toDatabase($notifiable) { 
        return $this->data;
    }

    public function toArray($notifiable)
    {
        return [
            'message' => $this->data['message'],
        ];
    }
}