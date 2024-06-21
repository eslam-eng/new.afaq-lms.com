<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Courses\Prices\CreateRequest;
use Illuminate\Http\Request;
use App\Models\CoursePrice;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class CoursePriceController extends Controller
{

    public function create($course_id)
    {
        $specialties = Course::find($course_id)->course_target;

        return view('admin.courses.prices.create', compact('specialties', 'course_id'));
    }



    public function store(CreateRequest $request, $course_id)
    {
        $data = $request->validated();

        $course = Course::find($course_id);
        if($course){
            $course->prices()->delete();
        }
        foreach ($data['data'] as $key => $prices) {
            $course->prices()->create($prices);
        }

        return redirect()->route('admin.courses.index');
    }


    public function show($course_id)
    {
        $course = Course::find($course_id);
        $prices = $course->prices()->get()->groupBy('specialty_id');

        if (count($prices) == 0) {

            return redirect('/admin/courses/' . $course_id . '/prices/create');
        }

        $specialties = $course->course_target;
        $course_id = $course->id;
        return view('admin.courses.prices.edit', compact('specialties', 'prices', 'course_id'));
    }


    public function update(CreateRequest $request, $course_id)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $course = Course::find($course_id);
            if($course){
                $course->prices()->delete();
            }
            foreach ($data['data'] as $key => $price) {
                CoursePrice::where('specialty_id', $price['specialty_id'])->where('course_id', $price['course_id'])->updateOrCreate($price);
            }
            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();
        }

        return redirect()->route('admin.courses.index');
    }
}
