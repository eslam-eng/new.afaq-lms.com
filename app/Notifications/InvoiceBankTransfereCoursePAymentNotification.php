<?php

namespace App\Notifications;

use App\Models\BankInvoice;
use App\Models\SystemEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class InvoiceBankTransfereCoursePAymentNotification extends Notification
{
    use Queueable;


    protected $items;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($items)
    {

        $this->items = $items;
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
                $email_content = SystemEmail::where('name_id', '=', 3)->first();
            }
            foreach ($this->items as $item) {
                if ($this->items[0]->course->id == $item->course->id) {
                    $course_name_en = $item->course->name_en;
                } else {
                    $course_name_en = $item->course->name_en . " and anther course with name :- " . $item->course->name_en;
                }
            }


            $subject = config('app.name') . ': Effective invoice email after course Bank payment   ';
            $content = "";
            $bank_account = config('app.bank_account_number', '5048833559940');
            $bank_IBAN = config('app.bank_iban_number', 'SA7920000005048833559940');

            if (!empty($email_content->subject)) {
                $subject = $email_content->subject;
                $subject = str_replace("{user_name}", $notifiable->full_name_en, $subject);
                $subject = str_replace("course_name", $course_name_en, $subject); //course_name_en

                $subject = str_replace("{bank_number}", $bank_account, $subject);
                $subject = str_replace("{bank_IBAN}", $bank_IBAN, $subject);
            }
            if (!empty($email_content->message)) {
                $content = $email_content->message;
                $content = str_replace("{user_name}", $notifiable->full_name_en, $content);
                $content = str_replace("{course_name}", $course_name_en, $content); //course_name_en
                $content = str_replace("{bank_number}", $bank_account, $content); //bank_number_en
                $content = str_replace("{bank_IBAN}", $bank_IBAN, $content); //bank_logo_en
                $content = str_replace("{bank_logo}", asset('nazil/imgs/riyad_bank.png'), $content); //bank_logo_en

            }
            return (new MailMessage)->view('frontend.new-mail-templete',['content' => $content])
                ->subject($subject);
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
