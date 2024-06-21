<?php

namespace App\Http\Controllers\Api\V1\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CourseResource;
use App\Http\Resources\Api\FeaturedResource;
use App\Models\Course;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WishlistApiController extends Controller
{
    public function add(Request $request)
    {
        try {

            $this->syncDataToUser($request);

            $v =  Validator::make($request->all(), [
                'course_id' => 'required|exists:courses,id',
                'user_id' => 'nullable|exists:users,id'
            ]);

            if ($v->fails()) {
                return $this->toJson(null, 400, $v->messages()->first(), false);
            }

            $user_id = null;
            $token = null;
            if ($request->user_id) {
                $user_id = $request->user_id;
            }
            if ($request->header('token')) {
                $token = $request->header('token');
            }

            if (!$token) {
                return $this->toJson(null, 400, 'device token required.', false);
            }

            $data['user_id'] = $user_id;
            $data['token'] = $token;
            $data['course_id'] = $request->course_id;

            $userData = [];
            if ($data['user_id']) {
                $userData = [
                    'user_id' => (int)$data['user_id']
                ];
            }

            $res = Wishlist::updateOrCreate([
                'token' => $data['token'],
                'course_id' => $data['course_id']
            ], $userData);

            return $this->toJson($res);
        } catch (\Throwable $th) {
            if (config('app.debug')) {
                //throw $th;
                return $this->toJson(null, 400, $th->getMessage(), false);
            }
        }
    }

    public function all(Request $request)
    {
        try {
            $this->syncDataToUser($request);

            $v =  Validator::make($request->all(), [
                'user_id' => 'nullable|exists:users,id'
            ]);

            if ($v->fails()) {
                return $this->toJson(null, 400, $v->messages()->first(), false);
            }

            $lang = app()->getLocale();
            $user_id = null;
            $token = null;
            if ($request->user_id) {
                $user_id = $request->user_id;
            }
            if ($request->header('token')) {
                $token = $request->header('token');
            }

            if (!$token) {
                return $this->toJson(null, 400, 'device token required.', false);
            }

            $data['user_id'] = $user_id;
            $data['token'] = $token;

            $courses = Course::select('courses.*', 'wishlists.course_id')
                ->join('wishlists', 'wishlists.course_id', '=', 'courses.id')
                ->where(function ($q) use ($data) {
                    if ($data['user_id']) {
                        $q->where('wishlists.user_id', $data['user_id'])->groupBy('wishlists.course_id');
                    } else {
                        $q->where('wishlists.token', $data['token'])->groupBy('wishlists.course_id');
                    }
                })
                ->distinct()
                ->paginate(request('page_size', 10));

            $res = $courses ? $courses->toArray() : null;
            if ($res) {
                $items['result'] = FeaturedResource::collection($courses);
                $items['current_page'] =  $res['current_page'];
                $items['total_pages'] =  $res['last_page'];
                $items['total'] =  $res['total'];
            } else {
                $items = null;
            }
            return $this->toJson($items);
        } catch (\Throwable $th) {
            if (config('app.debug')) {
                //throw $th;
                return $this->toJson(null, 400, $th->getMessage(), false);
            }
        }
    }

    public function remove(Request $request)
    {
        try {
            $this->syncDataToUser($request);

            $v =  Validator::make($request->all(), [
                'course_id' => 'required|exists:courses,id',
                'user_id' => 'nullable|exists:users,id'
            ]);

            if ($v->fails()) {
                return $this->toJson(null, 400, $v->messages()->first(), false);
            }

            $user_id = null;
            $token = null;
            if ($request->user_id) {
                $user_id = $request->user_id;
            }
            if ($request->header('token')) {
                $token = $request->header('token');
            }

            if (!$token) {
                return $this->toJson(null, 400, 'device token required.', false);
            }

            $data['user_id'] = $user_id;
            $data['token'] = $token;
            $data['course_id'] = $request->course_id;

            if ($data['user_id']) {
                $getItems = [
                    'user_id' => $data['user_id'],
                    'course_id' => $data['course_id'],
                ];
            } else {
                $getItems = [
                    'token' => $data['token'],
                    'course_id' => $data['course_id'],
                ];
            }

            $res = Wishlist::where($getItems)->delete();

            return $this->toJson($res ? true : false);
        } catch (\Throwable $th) {
            if (config('app.debug')) {
                //throw $th;
                return $this->toJson(null, 400, $th->getMessage(), false);
            }
        }
    }

    public function syncDataToUser(Request $request)
    {
        if ($request->header('token') && $request->user_id) {
            return  Wishlist::where('token', $request->header('token'))->update(['user_id' => $request->user_id]);
        }
        return false;
    }
}
