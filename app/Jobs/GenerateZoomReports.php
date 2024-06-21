<?php

namespace App\Jobs;

use App\Http\Controllers\Admin\ZoomMeetingController;
use App\Models\ZoomMeeting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateZoomReports implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $zooms = ZoomMeeting::all();
        foreach ($zooms as $zoom) {
            if (strtotime($zoom->end_time) <= strtotime(now())) {
                $zoom_controller = new ZoomMeetingController();
                $zoom_controller->reportsWithoutRedirect($zoom->id);
            }
        }
    }
}
