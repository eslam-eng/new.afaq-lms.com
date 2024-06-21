<?php

namespace App\Notifications;

use App\Models\SystemEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ReminderCourseNotification extends Notification
{
    use Queueable;

    protected $item;
    protected $data;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($item,$data)
    {
        $this->item = $item;
        $this->data = $data;
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
        //dd($notifiable->full_name_en);
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

            //         dd($notifiable);
            if (empty($email_content)) {
                $email_content = SystemEmail::where('name_id', '=', 4)->first();
            }

            $subject = config('app.name') . ': Course Reminder  ';
            $content = "";
            if (!empty($email_content->subject)) {
                $subject = $email_content->subject;
//                $content = str_replace("{user_name}", $notifiable->full_name_en, $content);
//                $content = str_replace("{course_name}", $this->item->name_en, $content); //course_name_en
//                $content = str_replace("{course_type}", $this->item->coursePlace->title_en, $content); //course_type
//                $content = str_replace("{course_location}", $this->item->location, $content); //course_type
            }
            if (!empty($email_content->message)) {
                $content = $email_content->message;
                //             dd($this->item);
                $content = str_replace("{user_name}", $notifiable->full_name_en, $content);
                $content = str_replace("{course_name}", $this->item->name_en, $content); //course_name_en
                $content = str_replace("{course_type}", $this->item->coursePlace->title_en, $content); //course_type
                $content = str_replace("{course_location}", $this->item->location, $content); //course_type
            }
            return (new MailMessage)->view('frontend.new-mail-templete',['content' => $content])
                ->subject($subject);
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
