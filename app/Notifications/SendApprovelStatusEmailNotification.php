<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class SendApprovelStatusEmailNotification extends Notification
{
    use Queueable;

    public function __construct($user,$reason,$status)
    {
        $this->user = $user;
        $this->reason = $reason;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return $this->getMessage();
    }

    public function getMessage()
    {
        return (new MailMessage)
            ->subject(config('app.name') . ': user ' . $this->user->full_name_en . ' is  ' . $this->status)
            ->greeting('Dear CEO,')
            ->line('by '.Auth::user()->name .' ,at '. date('Y-m-d H:i:s'))
            ->line('because '.$this->reason )
            ->action(config('app.name'), route('admin.users.show', ['user' => $this->user->id]))
            ->line('Thank you')
            ->line(config('app.name') . ' Team')
            ->salutation(' ');
    }
}
