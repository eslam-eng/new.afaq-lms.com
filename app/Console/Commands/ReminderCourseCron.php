<?php

namespace App\Console\Commands;

use App\Models\Course;
use App\Models\User;
use App\Models\UsersCourse;
use App\Notifications\ReminderCourseNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class ReminderCourseCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remindercourse:cron';

    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = 'Respectively send an Reminder of Course to everyone daily via email.';

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
        $items = UsersCourse::with('course', 'user')
            ->whereHas('course', function ($q) {
                $q->where('start_date', '=', Carbon::now()->addDay()->format('Y-m-d'))
                    ->with('coursePlace', function ($q) {
                        $q->where('courses.course_place_id', 'lookup_type_id');
                    });
            })
            ->get();
        foreach ($items as $item) {
            $users = $item->user;
            try {
                $data =[
                    'user_id' => $users->id,
                    'message' => 'Handle in reminder',
                    'title_en' => 'Handle in reminder',
                    'title_ar' => 'Handle in reminder',
                    'message_en' => 'Handle in reminder',
                    'message_ar' => 'Handle in reminder',
                    'type' => 'course',
                    'parent_id' => null,
                ];
                Notification::send($users, new ReminderCourseNotification($item->course , $data));
                //code...
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    }

}

