<?php

namespace App\Notifications;

use App\Models\SystemEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class CertificateExportingNotification extends Notification
{
    use Queueable;

    protected $course;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($course)
    {
        $this->course = $course;

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
            if (empty($email_content)) {
                $email_content = SystemEmail::where('name_id', '=', 6)->first();
            }

            $subject = config('app.name') . ': Certificate Exported  ';
            $content = "";
            if (!empty($email_content->subject)) {
                $subject = $email_content->subject;

                $subject = str_replace("{course_name}", $this->course->name_en, $subject); //course_name_en

                $subject = str_replace("{user_name}", $notifiable->full_name_en, $subject);
                // $subject = str_replace("{course_type}", $this->course->course_place, $subject); //course_type
            }
            if (!empty($email_content->message)) {
                $content = $email_content->message;

                $content = str_replace("{user_name}", $notifiable->full_name_en, $content);

                $content = str_replace("{course_name}", $this->course->name_en, $content);//course_name_en

                // $content = str_replace("{course_type}", $this->course->course_place, $content); //course_type
            }

            return (new MailMessage)->view('frontend.new-mail-templete',['content' => $content])
                ->subject($subject);

            //code...
        } catch (\Throwable $th) {

            //throw $th;
        }
    }
}
