<?php

namespace App\Console;

use App\Console\Commands\CheckPaymentPendingStatus;
use App\Jobs\CheckPayments;
use App\Jobs\CouponControlJob;
use App\Jobs\GenerateZoomReports;
use App\Jobs\GetPaymentsFormHyper;
use App\Jobs\UpdateCartJob;
use App\Models\User;
use Aws\Command;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Notifications\RealTimeNotification;
use Illuminate\Support\Facades\Notification;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [

        Commands\ReminderCourseCron::class,
        Commands\NotificationCampainCron::class,
        Commands\CheckPaymentPendingStatus::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('remindercourse:cron')->daily();
        $schedule->command('notification:run')->everyMinute();
        $schedule->command('payment:pending')->everyMinute();
        
        $schedule->call(function () {
            GetPaymentsFormHyper::dispatch();
        })->everyMinute();

        /*
        $schedule->call(function () {
            GenerateZoomReports::dispatch();
        })->everyMinute();
        $schedule->call(function () {
            CouponControlJob::dispatch();
        })->everyMinute();
        $schedule->call(function () {
            UpdateCartJob::dispatch();
        })->everyMinute();
        */
        
        $schedule->command('database:backup')->daily();

        $courses = \App\Models\Course::all();
    
        foreach ($courses as $course) {
            $startTime = $course->start_time; // Replace with the actual start time property of your Course model

            $schedule->call(function () use ($course) {
                // Retrieve the user IDs you want to send notifications to
                $userIds = [1, 2, 3]; // Replace with the desired user IDs

                // Retrieve the users based on the IDs
                $users = User::whereIn('id', $userIds)->get();

                // Prepare the notification data
                $notificationData = [
                    'message' => 'new course added',
                    'title_en' => 'new course added',
                    'title_ar' => 'new course added ',
                    'message_en' => 'new course added',
                    'message_ar' => 'new course added ',
                    'type' => 'course',
                    'parent_id' => null,
                ];

                // Send the notification to the users
                Notification::send($users, new RealTimeNotification($notificationData));
            })->dailyAt($startTime);
        }

        $schedule->command('queue:work --tries=3')
            ->everyMinute()
            ->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
