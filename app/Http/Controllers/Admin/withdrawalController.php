<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\Role;
use App\Models\User;


class withdrawalController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        $users = User::whereNotNull('deleted_at')->get();

        $roles = Role::get();

        return view('admin.users.index', compact('users', 'roles'));
    }
}
