<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Country;
use App\Models\Role;
use App\Models\Specialty;
use App\Models\SubSpecialty;
use App\Models\User;
use App\Models\UserLog;
use App\Models\Wallet;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use function Symfony\Component\VarDumper\Dumper\esc;

class UsersController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $users = User::with('country_and_nationality')
                ->whereHas('roles', function ($q) {
                    $q->whereIn('id', [1, 2,4]);
                });

            return DataTables::of($users)->make(true);
        } else {
            return view('admin.users.index');
        }
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::select(
            "id",
            "country_enNationality",
            "country_arNationality",
            'country_code',
            'order'
        )->orderBy('order', 'asc')->get();
        $roles = Role::all()->pluck('title', 'id');
        $specialists = Specialty::pluck('name_' . app()->getLocale(), 'id');

        return view('admin.users.create', compact('roles', 'specialists', 'countries'));
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->all();
        $data['approved'] = 1;
        $user = User::create($data);
        $user->roles()->sync($request->input('roles', []));

        if ($request->input('personal_photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . $request->input('personal_photo')))->toMediaCollection('personal_photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }

        return redirect(url('admin/' . request('type', 'users')));
        // return redirect()->route('admin.users.index', ['type' => request('type', 'users')]);
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');
        $user->load('roles');
        $countries = Country::select(
            "id",
            "country_enNationality",
            "country_arNationality",
            'country_code',
            'order'
        )->orderBy('order', 'asc')->get();
        $specialists = Specialty::pluck('name_' . app()->getLocale(), 'id');
        $sub_specialists = SubSpecialty::pluck('name_' . app()->getLocale(), 'id');
        return view('admin.users.edit', compact('roles', 'user', 'sub_specialists', 'specialists', 'countries'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->all();
        if (empty($request->password)) {
            unset($data['password']);
        }
        $user->update($data);
        $user->roles()->sync($request->input('roles', []));

        if ($request->file('personal_photo', false)) {
            if (!$user->personal_photo || $request->file('personal_photo') !== $user->personal_photo->file_name) {
                if ($user->personal_photo) {
                    $user->personal_photo->delete();
                }
                $user->addMedia($request->file('personal_photo'))->toMediaCollection('personal_photo');
            }
        }
        return redirect(url('admin/' . request('type', 'users')));
        // return redirect()->route('admin.users.index', ['type' => request('type', 'users')]);
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load([
            'roles',
            'userPayments',
            'userUserAlerts',
            'specialty',
            'SubSpecialty',
            'country_and_nationality',
            'userUserMemberships', 'userInvoices',
            'courses' => function ($query) {
                $query->distinct();
            }
        ]);

        // Get user log
        $user_logs = UserLog::where('user_id', $user->id)->get()->toArray();

        return view('admin.users.show', compact('user', 'user_logs'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back()->with('message', __('global.delete_account_success'));;
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('user_create') && Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new User();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function verify(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        //abort_if(!$user, 404);
        if ($user) {
            $user->approved           = 1;
            $user->verified           = 1;
            $user->verified_at        = Carbon::now()->format(config('panel.date_format') . ' ' . config('panel.time_format'));
            $user->email_verified_at  = Carbon::now()->format(config('panel.date_format') . ' ' . config('panel.time_format'));
            $user->status = 'verified';
            $user->save();

            return back()->with('message', 'User Approved');
        } else
            return back()->withErrors($user, 404);
    }

    public function getUsers(Request $request)
    {
        $users = User::where('email','like','%'.$request->email.'%')->select('id','email')->get();

        return $users;
    }
    public function getUserWallet(Request $request)
    {
        $wallet = Wallet::where('user_id',$request->id)->first();
        if ($wallet )
        {
            if($wallet->balance && $wallet->balance  > $request->amount){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
