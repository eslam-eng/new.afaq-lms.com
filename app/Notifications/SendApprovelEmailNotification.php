<?php

namespace App\Notifications;

use App\Models\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Support\HtmlString;
use App\Models\SystemEmail;

class SendApprovelEmailNotification extends Notification
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

            $app_link = '<div style="text-align:center"><a href="' . config('app.url') . '" rel="noopener" style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,Roboto,Helvetica,Arial,sans-serif;border-radius:4px;color:#fff;display:inline-block;overflow:hidden;text-decoration:none;background-color:#2d3748;border-bottom:8px solid #2d3748;border-left:18px solid #2d3748;border-right:18px solid #2d3748;border-top:8px solid #2d3748;font-size: 13px;" target="_blank" >' . config('app.name') . '</a><br><br></div>';

            if (empty($email_content)) {
                $email_content = SystemEmail::where('type', '=', 1)->where('name_id', '=', 1)->first();
                //            if($email_content->course_id){
                //                $course= Course::find($email_content->course_id);
                //            }elseif ($email_content->exam_id){
                //
                //            }
            }

            $subject = config('app.name') . ':  Registration Completion ';
            $content = "";
            if (!empty($email_content->subject)) {
                $subject = $email_content->subject;
            }
            if (!empty($email_content->message)) {
                $content = $email_content->message;
                $content = str_replace("{user_name}", $this->user->full_name_en, $content);
                $content = str_replace("{user_email}", $this->user->email, $content);
                $content = str_replace("<p>{app_link}</p>", $app_link, $content);
                //            if($email_content->course_id){
                //                $content = str_replace("{course_name}",$course->full_name_en, $content);
                //            }

            }

            return (new MailMessage)->view('frontend.new-mail-templete',['content' => $content])
                ->subject($subject);
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
