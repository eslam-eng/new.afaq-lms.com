<?php

namespace App\Notifications;

use App\Models\SystemEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;
use Intervention\Image\Image;

class AttendanceCardNotification extends Notification
{
    use Queueable;

    protected $user_attendance;
    protected $data;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user_attendance)
    {

        $this->user_attendance = $user_attendance;
//        $this->data = $data;

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

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */



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
        $data=$this->user_attendance->qrcode;
//$imgURL= $data;




        try {
//            if ($data)
//            {
//                $name = time().'.' . explode('/', explode(':', substr($data, 0, strpos($data, ';')))[1])[1];
//                \Intervention\Image\Facades\Image::make($data)->save(public_path('afaq/attendance-card/').$name);
//
//            }
            // dd($notifiable);
            if (empty($email_content)) {
                $email_content = SystemEmail::where('name_id', '=', 13)->first();
            }

            $subject = config('app.name') . ': Attendance Card   ';
            $content = "";

            if (!empty($email_content->subject)) {
                $subject = $email_content->subject;

            }
            if (!empty($email_content->message)) {

                $name = time().'.' . explode('/', explode(':', substr($data, 0, strpos($data, ';')))[1])[1];
                \Intervention\Image\Facades\Image::make($data)->save(public_path('afaq/attendance-card/').$name);


                $content = $email_content->message;

                $content = str_replace("{user_name}", $notifiable->full_name_en, $content);
                $content = str_replace("{QR}",$name , $content); //course_name_en

            }
            return (new MailMessage)->view('frontend.new-mail-templete',['content' => $content])
                ->subject($subject);

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
