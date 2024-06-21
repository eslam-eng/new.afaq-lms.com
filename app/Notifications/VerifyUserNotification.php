<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Support\HtmlString;
use App\Models\SystemEmail;

class VerifyUserNotification extends Notification
{
    use Queueable;

    private $user = null;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        try {

            $verification_link = '<div style="text-align:center"><a href="' . route('userVerification', $this->user->verification_token) . '" rel="noopener" style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,Roboto,Helvetica,Arial,sans-serif;border-radius:4px;color:#fff;display:inline-block;overflow:hidden;text-decoration:none;background-color:#2d3748;border-bottom:8px solid #2d3748;border-left:18px solid #2d3748;border-right:18px solid #2d3748;border-top:8px solid #2d3748;font-size: 13px;" target="_blank" >Click here to verify</a><br><br></div>';

            if (empty($email_content)) {
                $email_content = SystemEmail::where('type', '=', 1)->where('name_id', '=', 2)->first();
            }
            // $email_content = SystemEmail::find(2);
            $subject = config('app.name') . ' Email Verification ';
            $content = "";
            if (!empty($email_content->subject)) {
                $subject = $email_content->subject;
            }
            if (!empty($email_content->message)) {
                $content = $email_content->message;
                $content = str_replace("{user_name}", $this->user->full_name_en, $content);
                $content = str_replace("{email}", $this->user->email, $content);
                $content = str_replace("{verified_date}", $this->user->email_verified_at, $content);

                $content = str_replace("<p>{verification_link}</p>", $verification_link, $content);
            }

            return (new MailMessage)->view('frontend.new-mail-templete',['content' => $content])
            ->subject($subject);
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
