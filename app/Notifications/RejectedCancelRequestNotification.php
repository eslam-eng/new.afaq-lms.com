<?php

namespace App\Notifications;

use App\Models\SystemEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class RejectedCancelRequestNotification extends Notification
{
    use Queueable;

    protected $cancelRequest;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($cancelRequest)
    {
        $this->cancelRequest = $cancelRequest;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
//        dd($notifiable->full_name_en);
        return $this->getMessage($notifiable);
    }

    /**
     * Get the array representation of the notification.
     *
     *
     *
     */
    public function getMessage($notifiable)
    {
        try {

//             dd($this->cancelRequest->course);
            if (empty($email_content)) {
                $email_content = SystemEmail::where('name_id', '=', 15)->first();
            }

            $subject = config('app.name') . ': Rejected Cancel Request  ';
            $content = "";
            if (!empty($email_content->subject)) {
                $subject = $email_content->subject;
//                $subject = str_replace("{course_name}", $this->cancelRequest->course->name_en, $subject); //course_name_en
//                $subject = str_replace("{user_name}", $notifiable->full_name_en, $subject);

            }
            if (!empty($email_content->message)) {
                $content = $email_content->message;
                //             dd($this->all->toArray());
                $content = str_replace("{user_name}", $notifiable->full_name_en, $content);
                $content = str_replace("{course_name}", $this->cancelRequest->course->name_en, $content); //course_name_en

            }
            return (new MailMessage)->view('frontend.new-mail-templete',['content' => $content])
                ->subject($subject);
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
