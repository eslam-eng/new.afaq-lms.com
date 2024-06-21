<?php

namespace App\Http\Controllers\Admin;

use App\Models\Certificat;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Instructor;
use App\Models\Lecture;
use App\Models\Membership;
use App\Models\Payment;
use App\Models\Specialty;
use App\Models\User;
use App\Models\UserMembership;
use App\Models\PaymentDetails;
use Illuminate\Support\Facades\Auth;

class HomeController
{
    public function index()
    {
        $user = Auth::user();
        $user_roles_arr = $user->roles->toArray();
        if (isset($user_roles_arr[0]['id']) && $user_roles_arr[0]['id'] == 3) {
            return redirect('/');
        } else {
            $payments_details = PaymentDetails::with(['user', 'course', 'instructor', 'payments'])->orderBy('id', 'desc')->take(10)
                ->get();
            $data['all_courses'] = Course::all();
            $data['courses'] = Course::count();
            $data['students'] = User::whereHas('roles', function ($q) {
                $q->where('id', 3);
            })->count();
            $data['exams'] = Exam::count();
            $data['certificates'] = Certificat::count();
            $data['instructors'] = Instructor::count();
            $data['orders'] = Payment::count();
            $data['specialites'] = Specialty::count();
            $data['members'] = UserMembership::count();

            $course_statistics = array_count_values($data['all_courses']->pluck('status')->toArray());

            return view('home', compact('data', 'payments_details', 'course_statistics'));
        }
    }
}
