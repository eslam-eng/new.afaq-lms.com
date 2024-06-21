<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class disapprovedController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('disapproved_student_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::where('status', 'like', 'Refused')->get();

        $roles = Role::get();

        return view('admin.users.index', compact('users', 'roles'));
    }
}
