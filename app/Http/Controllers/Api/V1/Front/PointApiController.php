<?php

namespace App\Http\Controllers\Api\V1\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\PointResource;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PointApiController extends Controller
{
    public function MyPoints()
    {
        $user = auth()->user();
        $point = Point::firstOrCreate(['user_id' => $user->id]);
        $data = new PointResource($point);
        return $this->toJson($data);
    }

    public function RedeemPoint()
    {
        $point = Point::firstOrCreate(['user_id' => auth()->user()->id]);
        $minimum_point_to_money = config('app.minimum_point_to_money', 10);

        if ($point && $point->points < 1) {
            return $this->toJson(null, 400, 'there is no points to redeem it', false);
        }

        if ($point && $point->points <  $minimum_point_to_money) {
            return $this->toJson(null, 400, 'minimum point you can redeem it is ' . $minimum_point_to_money, false);
        }

        if (points('redeem')) {
            return $this->MyPoints();
        }

        return $this->toJson(null, 400, 'some thimg wrong', false);
    }

    public function InvitePoint(Request $request)
    {
        $v =  Validator::make($request->all(), [
            'code' => 'required|exists:points,invite_code'
        ]);

        if ($v->fails()) {
            return $this->toJson(null, 400, $v->messages()->first(), false);
        }

        $user = auth()->user();
        $point = Point::firstOrCreate(['user_id' => auth()->user()->id]);

        if ($point && $point->use_code) {
            return $this->toJson(null, 400, 'this user use invite code before', false);
        }

        if ($point->invite_code == request('code')) {
            return $this->toJson(null, 400, 'you can not use your code.', false);
        }

        if (points('invite')) {
            return $this->MyPoints();
        }

        return $this->toJson(null, 400, 'some thimg wrong', false);
    }
}
