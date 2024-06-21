<?php

namespace App\Scopes;

use App\Models\Course;
use App\Models\CourseConfigration;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Request;

class PublishedScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        if(app()->runningInConsole()) return $builder;
        
        if (Request::segment(1) != 'admin') {
            if(auth()->check()){
                if(!auth()->user()->roles()->where('id',1)->exists()){
                    $builder->where('status', 1);
                }
            }else{
                $builder->where('status', 1);
            }

            $course_order = CourseConfigration::where(['type' => 'course', 'key' => 'order'])->first();
            if ($course_order) {
                $order = CourseConfigration::where(['type' => 'order', 'id' => $course_order->value])->first();

                if ($order) {
                    $course = new Course();
                    if (in_array($order->key, $course->getFillable())) {
                        $builder->orderBy($order->key, $order->value);
                    }
                }
            }
        }
    }
}
