<?php

namespace App\Console\Commands;

use App\Models\NotificationCampain;
use App\Models\User;
use App\Models\UserToken;
use Illuminate\Console\Command;

class NotificationCampainCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'notification run';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $campains = NotificationCampain::with('users')->where('status', 0)->whereDate('send_at', '<=', now())->get();
            foreach ($campains as $campain) {
                if ($campain->specialty_id) {
                    $users = $campain->users;
                } else {
                    $users = User::all();
                }
                foreach ($users as $user) {
                    SendNotification([
                        'title_en' => $campain->title_en,
                        'message_en' => $campain->message_en,
                        'title_ar' => $campain->title_ar,
                        'message_ar' => $campain->message_ar,
                    ], UserToken::where('user_id', $user->id)->get(), $campain);
                }
                $campain->update(['status' => 1]);
            }

            $this->info('notification sent');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
