<?php

namespace App\Http\Controllers\Traits;

use App\Models\Course;
use App\Models\UsersCourse;
use Carbon\Carbon;

trait CalculateCourseCompletion
{
    public function updateCourseCompletion($course_id, $user_id = null)
    {
        // Get User course
        $user_courses = UsersCourse::where('course_id', $course_id);

        if ($user_id) {
            $user_courses = $user_courses->where('user_id', $user_id);
        }

        $user_courses = $user_courses->get();

        $course = Course::where('id', $course_id)->withCount(['lectures' => function ($lectures) {
            $lectures->whereIn('type', ['zoom', 'quize', 'video','attendance_design']);
        }])->first();
        // Check if user reserved this course before update completion percentage
        if (count($user_courses)) {

            foreach ($user_courses as $user_course) {
                // Calculate Zoom join percentage
                $zoom_reports_percentage_count = 0;
                $zooms = $course->zooms;

                foreach ($zooms as $key => $zoom) {
                    $zoom_reports_percentage_count += $zoom->reports()->where('user_id', $user_course->user_id)->sum('join_percentage');
                }

                // Calculate Quizes Scores percentage
                $quizes_percentage_count = $course->quizesScores()->where('user_id', $user_course->user_id)->sum('score_percentage');

                // Calculate Video Scores percentage
                $video_percentage_count = $course->courseVideoScore()->where('user_id', $user_course->user_id)->sum('score_percentage');

                // Calculate Attendance Scores percentage
                $attendance_percentage_count = $course->attends()->where('user_id', $user_course->user_id)->sum('percentage');


                // Calculate completion percentage
                $current_percentage = ($video_percentage_count + $quizes_percentage_count + $zoom_reports_percentage_count + $attendance_percentage_count) / ($course->lectures_count);

                // Update completion percentage
                $user_course->update([
                    'completion_percentage' => $current_percentage > 100 ? 100 : $current_percentage
                ]);
                if ($user_course->completion_percentage >= $course->success_percentage )
                {
                    $user_course->update([
                        'completion_date'  =>Carbon::now()
                    ]);

                }
            }
        }
    }
}
