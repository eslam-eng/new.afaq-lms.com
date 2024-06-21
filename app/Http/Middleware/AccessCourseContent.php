<?php

namespace App\Http\Middleware;

use App\Models\Enroll;
use Closure;
use Illuminate\Http\Request;

class AccessCourseContent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            if (Enroll::where(['user_id' => auth()->user()->id, 'course_id' => $request->course_id, 'approved' => 1])->exists()) {
                return $next($request);
            }elseif(auth()->user()->roles()->where('id',1)->exists()){
                return $next($request);
            }
            else{
                return back()->with('error',"You can't see content please reserve this course and try again.");
            }
        }else{
            return redirect('ar/login');
        }
    }
}
