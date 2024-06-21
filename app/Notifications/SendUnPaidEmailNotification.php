<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Support\HtmlString;
use App\Models\SystemEmail;

class SendUnPaidEmailNotification extends Notification
{
    use Queueable;

    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
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
        try {

            if (empty($email_content)) {
                $email_content = SystemEmail::where('type', '=', 1)->where('name_id', '=', 8)->first();
            }

            $subject = config('app.name') . ': Reminder to fulfil the fees of ';
            $content = "";
            if (!empty($email_content->subject)) {
                $subject = $email_content->subject;
            }
            if (!empty($email_content->message)) {
                $content = $email_content->message;
                $content = str_replace("{user_name}", $this->user->full_name_en, $content);
                $content = str_replace("{user_email}", $this->user->email, $content);
            }

            return (new MailMessage)->view('frontend.new-mail-templete',['content' => $content])
                ->subject($subject);
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
