<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Support\HtmlString;
use App\Models\SystemEmail;

class SendPindingEmailNotification extends Notification
{
    use Queueable;

    protected $user;
    protected $reason;
    protected $status;
    public function __construct($user, $reason, $status)
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
        try {

            if (empty($email_content)) {
                $email_content = SystemEmail::where('type', '=', 1)->where('name_id', '=', 6)->first();
            }
            $subject = config('app.name') . ': Application Processing  ';
            $content = "";
            if (!empty($email_content->subject)) {
                $subject = $email_content->subject;
            }
            if (!empty($email_content->message)) {
                $content = $email_content->message;
                $content = str_replace("{user_name}", $this->user->full_name_en, $content);
                $content = str_replace("{reasons}", $this->reason, $content);
            }

            return (new MailMessage)->view('frontend.new-mail-templete',['content' => $content])
                ->subject($subject);
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
