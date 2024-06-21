<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class approvedController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('approved_student_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $users = User::with('country_and_nationality')
            ->whereHas('roles', function ($q) {
                $q->whereIn('id', [3]);
            });

            return DataTables::of($users)->make(true);
        }else{
            return view('admin.users.index');
        }
    }
}
