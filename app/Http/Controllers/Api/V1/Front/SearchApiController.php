<?php

namespace App\Http\Controllers\Api\V1\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\SearchResource;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SearchApiController extends Controller
{
    public $data = [];

    public function __construct()
    {
        $this->data = [];
    }

    public function search(Request $request)
    {
        try {

            $v = $this->validateData($request);

            if ($v->fails()) {
                return $this->toJson(null, 400, $v->messages()->first(), false);
            }

            $all_courses = Course::with('courseTrack', 'coursePlace', 'course_target')->where('show_for_all', 1)->get();
            $courses = Course::with('courseTrack', 'coursePlace', 'course_target')->where('show_for_all', 1);

            $courses = $this->filter($courses);

            $courses = $this->sort($courses);

            $this->data['result'] = SearchResource::collection($courses);

            $this->data['filters'] = $this->getFilters($all_courses);

            $this->data['sort'] = $this->getSortFilters();

            // $this->data['text'] = request('q');

            return $this->toJson($this->data);
        } catch (\Throwable $th) {
            if (config('app.debug')) {
                throw $th;
                return $this->toJson(null, 400, $th->getMessage(), false);
            }
        }
    }

    private function validateData($request)
    {
        if (request('track_id')) {
            $request->merge(['track_id' => json_decode($request->track_id, true) ?? $request->track_id]);
        }
        if (request('type_id')) {
            $request->merge(['type_id' => json_decode($request->type_id, true) ?? $request->type_id]);
        }
        if (request('specialty_id')) {
            $request->merge(['specialty_id' => json_decode($request->specialty_id, true) ?? $request->specialty_id]);
        }
        if (request('price')) {
            $request->merge(['price' =>  json_decode($request->price, true) ?? $request->price]);
        }
        if (request('language')) {
            $request->merge(['language' =>  json_decode($request->language, true) ?? $request->language]);
        }
        return $v =  Validator::make($request->all(), [
            'track_id'     => 'nullable|array',
            'track_id.*'     => 'required',

            'type_id'      => 'nullable|array',
            'type_id.*'     => 'required',

            'specialty_id' => 'nullable|array',
            'specialty_id.*'     => 'required',

            'price'        => 'nullable|array',
            'price.*'     => 'required',

            'language'        => 'nullable|array',
            'language.*'     => 'required',

        ]);
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

        $courses = $courses->paginate(request('page_size', 10));

        $this->data['current_page']  = $courses ? (int) $courses->toArray()['current_page'] : null;
        $this->data['total_pages']   = $courses ? (int) $courses->toArray()['last_page'] : null;
        // $this->data['courses'] = $courses ?  $courses->toArray() : null;


        if (request('price')) {

            $courses =  $courses->filter(function ($q) {
                if (in_array('free', request('price'))) {
                    return $q->today_price < 1;
                }
                if (in_array('less_than_100', request('price'))) {
                    return $q->today_price > 1 && $q->today_price < 100;
                }
                if (in_array('from_100_to_499', request('price'))) {
                    return $q->today_price > 100 && $q->today_price < 499;
                }
                if (in_array('from_500_to_1000', request('price'))) {
                    return $q->today_price > 499 && $q->today_price < 1000;
                }
                if (in_array('more_than_1000', request('price'))) {
                    return $q->today_price > 1000;
                }
            });
        }
        return $courses;
    }

    private function sort($courses)
    {
        switch (request('sort')) {
            case 'most_rate':
                $courses = $courses->SortByDesc('rate');
                break;
            case 'most_price':
                $courses = $courses->SortByDesc('today_price');
                break;
            case 'less_price':
                $courses = $courses->SortBy('today_price');
                break;
            case 'last_create':
                $courses = $courses->sortByDesc('id');
                break;
            case 'first_create':
                $courses = $courses->SortBy('id');
                break;
            default:
                $courses = $courses->SortByDesc('id');
                break;
        }

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
        array_push($data, ['key' => 'tracks', 'title' => __('home.tracks'), 'value' => $tracks]);

        /************************* types *****/
        $types = $courses->pluck('coursePlace.title_' . $lang, 'coursePlace.id')->map(function ($value, $id) {
            return ['key' => (string)$id, 'value' => $value];
        })->filter(fn ($i) => $i['value'] != null)->values();
        array_push($data, ['key' => 'types', 'title' => __('home.types'), 'value' => $types]);

        /*********************** specialty *****/
        $specialties = collect($specialty)->unique('key')->filter(fn ($i) => $i['value'] != null)->values();
        array_push($data, ['key' => 'specialty', 'title' => __('home.specialty'), 'value' => $specialties]);

        /************************ price *****/
        $price = collect($prices)->unique('key')->sortBy('order')->values();
        array_push($data, ['key' => 'price', 'title' => __('home.price'), 'value' => $price]);

        /*********************** language *****/
        $languages = [
            ['key' => 'ar', 'value' => __('home.ar')],
            ['key' => 'en', 'value' => __('home.en')],
        ];
        array_push($data, ['key' => 'language', 'title' => __('home.language'), 'value' => $languages]);

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
