<?php

namespace App\Notifications;

use App\Models\SystemEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\HtmlString;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoiceAfterCoursePaymentNotification extends Notification
{
    use Queueable;


    protected $items;
    protected $user;
    protected $data;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($items, $user ,$data)
    {
        $this->items = $items;
        $this->user = $user;
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
        return ['mail','database'];
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
                $email_content = SystemEmail::where('name_id', '=', 8)->first();
            }
            foreach ($this->items as $item) {
                if ($this->items[0]->course->id == $item->course->id) {
                    $course_name_en = $item->course->name_en;
                } else {
                    $course_name_en = $item->course->name_en . " and anther course with name :- " . $item->course->name_en;
                }
            }
            $subject = config('app.name') . ': Effective invoice email after course payment   ';
            $content = "";
            if (!empty($email_content->subject)) {
                $subject = $email_content->subject;
//                $subject = str_replace("{user_name}", $this->user->full_name_en, $subject);
                // $subject = str_replace("{course_name}", $course_name_en, $subject);//course_name_en

                // $subject = str_replace("{invoice_creation_date}", $this->items->created_at, $subject);//payment dat
            }
            if (!empty($email_content->message)) {
                $content = $email_content->message;
                $content = str_replace("{user_name}", $notifiable->full_name_en, $content);
                $content = str_replace("{course_name}", $course_name_en, $content); //course_name_en

                $content = str_replace("{invoice_creation_date}", $this->items[0]->created_at, $content); //payment dat
            }
            return (new MailMessage)->view('frontend.new-mail-templete',['content' => $content])
                ->subject($subject);
                // ->greeting('')
                // ->line(new HtmlString())
                // ->salutation(' ');

            //code...
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
