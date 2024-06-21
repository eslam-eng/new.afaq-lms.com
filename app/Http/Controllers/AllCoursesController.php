<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAllCourseRequest;
use App\Http\Requests\StoreAllCourseRequest;
use App\Http\Requests\UpdateAllCourseRequest;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Lookup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Events\PopUserNotification;
use App\Notifications\RealTimeNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewOrderNotification;
use Illuminate\Notifications\Events\BroadcastNotificationCreated;

class AllCoursesController extends Controller
{
    public function index(Request $request)
    {
        $all_courses = Course::with('courseTrack', 'coursePlace', 'course_target')
            ->whereNotNull('order')
            ->where('show_for_all', 1)
            ->get();
        $courses = Course::with('courseTrack', 'coursePlace', 'course_target')
            ->where('show_for_all', 1);

        $courses = $this->filter($courses);
        $courses = $this->sort($courses);


        $filters = json_decode(json_encode($this->getFilters($all_courses)));

        return view('frontend.show-all-courses', compact('courses', 'filters'));
    }

    public function my_courses()
    {
        $courses = Course::with(['cartItems', 'category', 'instructor', 'media', 'course_instructor'])->whereHas('cartItems', function ($q) {
            $q->where('status', 1)->where('user_id', auth()->user()->id);
        });

        if (request('text')) {
            $courses = $courses->where(function ($q) {
                $q->where('name_' . app()->getLocale(), 'like', '%' . request('text') . '%')
                    ->orWhere('introduction_to_course_' . app()->getLocale(), 'like', '%' . request('text') . '%');
            });
        }

        if (request('category_id')) {
            $courses = $courses->where('category_id', request('category_id'));
        }

        if (request('price')) {
            if (request('price') == 'free') {
                $courses = $courses->where(function ($q) {
                    $q->whereNull('price')->orWhere('price', '<=', 0);
                });
            } else {
                $courses = $courses->whereNotNull('price')->where('price', '>', 0);
            }
        }

        if (request('f_price')) {
            if (request('f_price') == 'free') {
                $courses = $courses->where(function ($q) {
                    $q->whereNull('price')->orWhere('price', '<=', 0);
                });
            } else {
                $courses = $courses->whereNotNull('price')->where('price', '>', 0);
            }
        }

        if (request('credit')) {
            $courses = $courses->whereNotNull('accreditation_number');
        }

        if (request('training_type') == 'course') {
            $courses = $courses->where('training_type', 'course');
        }

        if (request('training_type_con') == 'conference') {
            $courses = $courses->where('training_type', 'conference');
        }

        if (request('history')) {
            $courses = $courses->where('end_date', '<', now());
        }

        if (request('sort')) {

            if (request('sort') == 'date_high') {
                $courses = $courses->orderBy('start_date', 'desc');
            } else if (request('sort') == 'date_low') {
                $courses = $courses->orderBy('start_date', 'asc');
            } else if (request('sort') == 'price_high') {
                $courses = $courses->orderBy('price', 'desc');
            } else if (request('sort') == 'price_low') {
                $courses = $courses->orderBy('price', 'asc');
            }
        }

        $courses = $courses->paginate(12);
        $courseCategories = CourseCategory::has('courses')->get();
        return view('frontend.show-my-courses', compact('courses', 'courseCategories'));
    }



    private function filter($courses)
    {

        if (request('q')) {
            $courses = $courses->where(function ($q) {
                $q->orWhere('name_en', 'like', '%' . request('q') . '%');
                $q->orWhere('name_ar', 'like', '%' . request('q') . '%');
                $q->orWhere('description_en', 'like', '%' . request('q') . '%');
                $q->orWhere('description_en', 'like', '%' . request('q') . '%');
            });
        }

        if (request('track_id')) {
            $courses = $courses->whereIn('course_track_id', request('track_id'));
        }

        if (request('type_id')) {
            $courses = $courses->whereIn('course_place_id', request('type_id'));
        }

        if (request('language')) {
            // $courses = $courses->whereIn('language', request('language'));
        }

        if (request('accreditation')) {
            $courses = $courses->whereNotNull('accreditation_number');
        }


        if (request('specialty_id')) {
            $courses = $courses->whereHas('course_target', function ($q) {
                $q->whereIn('specialty_id', request('specialty_id'));
            });
        }

        if (request('price')) {
            if (in_array('free', request('price'))) {
                $courses = $courses->where('price', 0);
            }
        }

        if (request('fin')) {
            if (request('fin') == 'free') {
                $courses = $courses->where('price', 0)->where('has_general_price', 1);
            }
        }
        $courses = $courses->paginate(request('page_size', 10));

        $this->data['current_page']  = $courses ? (int) $courses->toArray()['current_page'] : null;
        $this->data['total_pages']   = $courses ? (int) $courses->toArray()['last_page'] : null;
        // $this->data['courses'] = $courses ?  $courses->toArray() : null;


        if (request('price') || request('fin')) {
            $sortedResult = $courses->getCollection();

            if (request('price')) {

                if (in_array('less_than_100', request('price'))) {
                    $sortedResult = $sortedResult->where('today_price', '>', 1)->where('today_price', '<', 100);
                }
                if (in_array('from_100_to_499', request('price'))) {
                    $sortedResult = $sortedResult->where('today_price', '>', 100)->where('today_price', '<', 499);
                }
                if (in_array('from_500_to_1000', request('price'))) {
                    $sortedResult = $sortedResult->where('today_price', '>', 499)->where('today_price', '<', 1000);
                }
                if (in_array('more_than_1000', request('price'))) {
                    $sortedResult = $sortedResult->where('today_price', '>', 1000);
                }
            }

            if (request('fin')) {
                if (request('fin') == 'free') {
                    $sortedResult = $sortedResult->where('price', 0)->where('has_general_price', 1);
                }

                if (request('fin') == 'paid') {
                    $sortedResult = $sortedResult->where('today_price', '>', 0);
                }
            }

            $result = collect($sortedResult->all());

            $courses = $courses->setCollection($result);
        }

        return $courses;
    }

    private function sort($courses)
    {
        $sortedResult = $courses->getCollection();
        switch (request('sort')) {
            case 'most_rate':
                // $courses = $courses->SortByDesc('today_price');
                break;
            case 'most_price':
                $sortedResult = $sortedResult->SortByDesc('today_price');
                break;
            case 'less_price':
                $sortedResult = $sortedResult->SortBy('today_price');
                break;
            case 'last_create':
                $sortedResult = $sortedResult->sortByDesc('id');
                break;
            case 'first_create':
                $sortedResult = $sortedResult->SortBy('id');
                break;
            default:
                $sortedResult = $sortedResult->SortBy('order'); // default Sort by order column
                break;
        }

        $result = $sortedResult->values();

        $courses = $courses->setCollection($result);
        return $courses;
    }

    private function getFilters($courses)
    {
        $data = [];
        $specialty = [];
        $prices = [];
        $lang = app()->getLocale();

        foreach ($courses as $course) {
            if ($course->today_price < 0) {
                array_push($prices,  ['key' => 'free', 'value' => __('home.free')]);
            }
            if ($course->today_price > 0 && $course->today_price < 100) {
                array_push($prices,  ['key' => 'less_than_100', 'value' => __('home.price_less', ['to' => 100]), 'order' => 1]);
            }
            if ($course->today_price >= 100 && $course->today_price < 500) {
                array_push($prices,  ['key' => 'from_100_to_499', 'value' => __('home.price_from_to', ['from' => 100, 'to' => 499]), 'order' => 2]);
            }
            if ($course->today_price >= 500 && $course->today_price < 1000) {

                array_push($prices,  ['key' => 'from_500_to_1000',  'value' => __('home.price_from_to', ['from' => 500, 'to' => 1000]), 'order' => 3]);
            }
            if ($course->today_price >= 1000) {
                array_push($prices,  ['key' => 'more_than_1000', 'value' => __('home.price_more', ['to' => 1000]), 'order' => 4]);
            }

            foreach ($course->course_target as $i) {
                array_push($specialty, ['key' => (string)$i['id'], 'value' => $i['name_' . $lang]]);
            }
        }

        /************************ tracks *****/
        $tracks = $courses->pluck('courseTrack.title_' . $lang, 'courseTrack.id')->map(function ($value, $id) {
            return ['key' => (string)$id, 'value' => $value];
        })->filter(fn ($i) => $i['value'] != null)->values();
        $data['tracks'] = $tracks;

        /************************* types *****/
        $types = $courses->pluck('coursePlace.title_' . $lang, 'coursePlace.id')->map(function ($value, $id) {
            return ['key' => (string)$id, 'value' => $value];
        })->filter(fn ($i) => $i['value'] != null)->values();

        $data['types'] = $types;
        /*********************** specialty *****/
        $specialties = collect($specialty)->unique('key')->filter(fn ($i) => $i['value'] != null)->values();
        $data['specialties'] = $specialties;

        /************************ price *****/
        $prices = collect($prices)->unique('key')->sortBy('order')->values();
        $data['prices'] = $prices;

        /*********************** language *****/
        $languages = [
            ['key' => 'ar', 'value' => __('home.ar')],
            ['key' => 'en', 'value' => __('home.en')],
        ];
        $data['languages'] = $languages;

        $this->data['accreditation'] =  ['key' => 'accreditation', 'title' => __('home.accreditation'), 'value' => "1"];

        return $data;
    }

    private function getSortFilters()
    {
        return [
            ['key' => 'most_rate', 'value' => __('home.most_rate')],
            ['key' => 'most_price', 'value' => __('home.most_price')],
            ['key' => 'less_price', 'value' => __('home.less_price')],
            ['key' => 'last_create', 'value' => __('home.last_create')],
            ['key' => 'first_create', 'value' => __('home.first_create')],
        ];
    }
}
