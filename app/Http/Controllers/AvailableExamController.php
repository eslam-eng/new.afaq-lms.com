<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAvailableExamRequest;
use App\Http\Requests\StoreAvailableExamRequest;
use App\Http\Requests\UpdateAvailableExamRequest;
use App\Models\Exam;
use App\Models\PaymentMethod;
use App\Models\UserExam;
use App\Payments\Factory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AvailableExamController extends Controller
{
    public function index()
    {
        $exams = Exam::with(['exam_title', 'certificate', 'media'])->where('status', 1)->paginate(12);
        return view('frontend.available_exams', compact('exams'));
    }
}
