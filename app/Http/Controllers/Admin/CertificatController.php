<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cache;
use Gate;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;

use App\Http\Requests\MassDestroyCertificatRequest;
use App\Http\Requests\StoreCertificatRequest;
use App\Http\Requests\UpdateCertificatRequest;

use App\Models\Certificat;
use App\Models\CertificateKey;
use App\Models\Course;
use App\Models\Exam;
use App\Models\CourseCertificate;
use App\Models\Enroll;
use App\Models\User;
use App\Models\UserCertificate;
use App\Models\UsersCourse;

use App\Notifications\CertificateExportingNotification;
use App\Jobs\GenerateCertificates;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CertificatController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('certificat_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $certificats = Certificat::with(['media'])->orderBy('id', 'desc')->get();

        return view('admin.certificats.index', compact('certificats'));
    }

    public function create()
    {
        abort_if(Gate::denies('certificat_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $keys = CertificateKey::all();
        return view('admin.certificats.create', compact('keys'));
    }

    public function store(StoreCertificatRequest $request)
    {
        $inputs = $request->all();

        $certificat = Certificat::create($inputs);

        if ($request->file('image', false)) {
            $certificat->addMedia($request->file('image'))->toMediaCollection('image');
        }

        $certificat->content = $request->cert;
        $certificat->save();
        return redirect()->route('admin.certificats.index');
    }

    public function edit(Certificat $certificat)
    {
        abort_if(Gate::denies('certificat_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $keys = CertificateKey::all();

        $canvas_json = json_decode($certificat->content, true) ?? null;

        return view('admin.certificats.edit', compact('certificat', 'keys', 'canvas_json'));
    }

    public function update(UpdateCertificatRequest $request, Certificat $certificat)
    {
        $certificat->update($request->all());

        if ($request->file('image', false)) {
            if (!$certificat->image || $request->file('image') !== $certificat->image->file_name) {
                if ($certificat->image) {
                    $certificat->image->delete();
                }
                $certificat->addMedia($request->file('image'))->toMediaCollection('image');
            }
        }
        $certificat->content = $request->cert;
        $certificat->save();

        return redirect()->route('admin.certificats.index');
    }

    public function show(Certificat $certificat)
    {
        abort_if(Gate::denies('certificat_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.certificats.show', compact('certificat'));
    }

    public function destroy(Certificat $certificat)
    {
        abort_if(Gate::denies('certificat_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $certificat->delete();

        return back()->with('message', __('global.delete_account_success'));
    }

    public function massDestroy(MassDestroyCertificatRequest $request)
    {
        Certificat::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('certificat_create') && Gate::denies('certificat_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Certificat();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }



    public function generate_certificates(Request $request, $course_id)
    {
        $course = Course::findOrFail($course_id);

        $search = $request->input('search.value');

        if($request->ajax()){
            $course_users_query = UsersCourse::with('user')
                ->select('users_courses.*')
                ->leftJoin('users', 'users.id', '=', 'users_courses.user_id')
                ->where('users_courses.course_id', $course_id)
                ->where(function ($query) use ($search) {
                    $query->whereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'LIKE', '%' . $search . '%')
                            ->orWhere('email', 'LIKE', '%' . $search . '%');
                    })->orWhere('completion_percentage', 'LIKE', '%' . $search . '%');
                })
                ->whereRaw('users_courses.id IN (
                    SELECT id
                    FROM (
                        SELECT id, ROW_NUMBER() OVER (PARTITION BY user_id ORDER BY completion_percentage DESC) AS row_num
                        FROM users_courses
                        WHERE course_id = ? 
                    ) AS ranked
                    WHERE row_num = 1
                )', [$course_id])
                ->when(request()->has('order') && is_array(request('order')), function($query){
                    foreach (request('order') as $order) {
                        $column = request('columns')[$order['column']]['data'];
                        $direction = $order['dir'];
                        
                        switch ($column) {
                            case 'user_id':
                                $query->orderBy('users.id', $direction);
                                break;
                            case 'user_name':
                                $query->orderBy('users.name', $direction);
                                break;
                            case 'user_email':
                                $query->orderBy('users.email', $direction);
                                break;
                            case 'completion_percentage':
                                $query->orderBy('users_courses.completion_percentage', $direction);
                                break;
                            case 'user_created_at':
                                $query->orderBy('users.created_at', $direction);
                                break;
                        }
                    }
                });

            $perPage = $request->input('length') ?? 10;
            $page = $request->input('start') / $perPage + 1;

            $course_users = $course_users_query->paginate($perPage, ['*'], 'page', $page);

            $course_users->getCollection()->transform(function ($userCourse) use ($request) {
                $data = $userCourse->toArray();
                $data['id'] = null;
                $data['user_created_at'] = $userCourse->user->created_at ?? null;
                $data['user_name'] = $userCourse->user->name ?? null;
                $data['user_email'] = $userCourse->user->email ?? null;
                $certificat = UserCertificate::where(['user_id' => $userCourse->user_id , 'course_id' => $userCourse->course_id])->first();

                $action = '';
                if(!$certificat){
                    $action = '<a class="btn btn-xs btn-primary p-1 m-1" href="/admin/generate_certificates/' . $userCourse->course_id . '/index?user_id=' . $userCourse->user_id . '&recipient_email=' . $request->input('recipient_email') . '"> اصدار الشهادات </a>';
                } else if($certificat && $certificat->certificate_img){
                    $imageCanvas = $certificat->certificate_img;

                    if(!str_starts_with($imageCanvas, 'data')){
                        $imageCanvas = json_decode($imageCanvas, true);
                        $imageCanvas = $imageCanvas['objects'][0]['src'];
                    }

                    $action = '<img src="' . ($imageCanvas) . '" style="width:100px">';
                }

                $data['action'] = $action;
                return $data;
            });

            $response = [
                'draw' => $request->input('draw'),
                'recordsTotal' => $course_users->total(),
                'recordsFiltered' => $course_users->total(),
                'data' => $course_users->items(),
            ];

            return response()->json($response);
        }

        if (!$course->is_generating_in_progress || $request->user_id) {

            GenerateCertificates::dispatchSync($course_id, $request->input('recipient_email'), $request->input('user_id'));

            $course->update([
                'is_generating_in_progress' => 1
            ]);
        }

        return view('admin.courses.generate_certificates_result', [
            'course_id' => $course_id,
            'recipientEmail' => request('recipient_email'),
        ]);
    }
}
