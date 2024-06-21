<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{

    public function get_course_landing_page($lang, $id)
    {
        // ??????????????????????///
        $front_end_url = config('app.APP_URL', 'https://afaq-lms.com');
        $name = $description = $image =  null;
        $course = Course::find($id);
        if ($course) {
            $image = $course->image->url ?? $course->image->url ?? null;
            $id = $course->id ?? null;
            $name = $course->name ?? null;
            $description = $course->description ?? null;
            $web_url = config('app.APP_URL', 'https://afaq-lms.com') . "/$lang/one-courses-new/$id";
            $app_link = "afaq://course?id=$id";

            return view('app_link.course_landing_page', compact('front_end_url', 'name', 'description', 'image', 'id', 'lang',  'web_url', 'app_link'));
        }
        return redirect(config('app.APP_URL', 'https://afaq-lms.com'));
    }
}
