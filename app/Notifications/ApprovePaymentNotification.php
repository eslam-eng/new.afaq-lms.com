<?php

namespace App\Notifications;

use App\Models\SystemEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ApprovePaymentNotification extends Notification
{
    use Queueable;


    protected $reservation;
    protected $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($reservation , $data)
    {

        $this->reservation = $reservation;
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
        return ['mail' ,'database'];
    }

    public function toMail($notifiable)
    {
        return $this->getMessage();
    }

    /**
     * Get the array representation of the notification.
     *
     *
     *
     */
    public function getMessage()
    {
        try {

            if (empty($email_content)) {
                $email_content = SystemEmail::where('name_id', '=', 11)->first();
            }
            foreach ($this->reservation->payment_details as $course) {
                if ($this->reservation->payment_details[0]->id == $course->id) {
                    $course_name_en = $course->course_name_en;
                } else {
                    $course_name_en = $$course->course_name_en . " and anther course with name :- " . $course->course_name_en;
                }
            }

            $subject = config('app.name') . ': Confirm Course Payment   ';
            $content = "";
            if (!empty($email_content->subject)) {
                $subject = $email_content->subject;
//                $subject = str_replace("{user_name}", $this->reservation->payment_details[0]->user_name_en, $subject);
//                $subject = str_replace("{course_name}", $course_name_en, $subject); //course_name_en
//                $subject = str_replace("{subscription_date}", $this->reservation->payment_details[0]->created_at, $subject); //subscription dat
//                $subject = str_replace("{payment_date}", $this->reservation->created_at, $subject); //payment dat
            }
            if (!empty($email_content->message)) {
                $content = $email_content->message;
                // dd($this->reservation->payment_details->toArray());
                $content = str_replace("{user_name}", $this->reservation->payment_details[0]->user_name_en, $content);
                $content = str_replace("{course_name}", $course_name_en, $content); //course_name_en
                $content = str_replace("{subscription_date}", $this->reservation->payment_details[0]->created_at, $content); //subscription dat
                $content = str_replace("{payment_date}", $this->reservation->created_at, $content); //payment dat
            }
//            return (new MailMessage)
//                ->subject($subject)
//                ->greeting('')
//                ->line(new HtmlString($content))
//                ->salutation(' ');
            return (new MailMessage)->view('frontend.new-mail-templete',['content' => $content])
                ->subject($subject);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

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
