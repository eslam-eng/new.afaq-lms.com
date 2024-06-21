<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Support\HtmlString;
use App\Models\SystemEmail;

class SendFirstAfterPaymentEmailNotification extends Notification
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

            $app_link = '<div style="text-align:center"><a href="https://docs.google.com/forms/d/e/1FAIpQLScYbuwU87n3llDK8snbwkwTHxK4jDYNEmo3Wa3IULPL2SmhkA/viewform?usp=sf_link" rel="noopener" style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,Roboto,Helvetica,Arial,sans-serif;border-radius:4px;color:#fff;display:inline-block;overflow:hidden;text-decoration:none;background-color:#2d3748;border-bottom:8px solid #2d3748;border-left:18px solid #2d3748;border-right:18px solid #2d3748;border-top:8px solid #2d3748;font-size: 13px;" target="_blank" >Click Here</a></br></br></div>';

            if (empty($email_content)) {
                $email_content = SystemEmail::where('type', '=', 1)->where('name_id', '=', 4)->first();
            }

            $subject = 'AFAQ: Polling of Elective Courses (1st Semester)';
            $content = "";
            if (!empty($email_content->subject)) {
                $subject = $email_content->subject;
            }
            if (!empty($email_content->message)) {
                $content = $email_content->message;
                $content = str_replace("{user_name}", $this->user->full_name_en, $content);
                $content = str_replace("<p>{poll_link}</p>", $app_link, $content);
            }

            return (new MailMessage)->view('frontend.new-mail-templete',['content' => $content])
                ->subject($subject);
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
