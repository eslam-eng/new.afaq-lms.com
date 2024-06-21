<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\Role;
use App\Models\User;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class UnverifiedController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('Unverified_student_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::whereNull('email_verified_at')->whereHas('roles', function ($q) {
            $q->where('id', 3);
        })->paginate(10);

        $roles = Role::get();

        return view('admin.users.index', compact('users', 'roles'));
    }
}
