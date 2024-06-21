<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PointResource;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PointsController extends Controller
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
            return back()->with('message','there is no points to redeem it');

        }

        if ($point && $point->points <  $minimum_point_to_money) {
            return back()->with('message','minimum point you can redeem it is ' . $minimum_point_to_money);

        }

        if (points('redeem')) {
            return back()->with('message','created successfully');
        }

    }

    public function InvitePoint(Request $request)
    {
        $v =  Validator::make($request->all(), [
            'code' => 'required|exists:points,invite_code'
        ]);

        if ($v->fails()) {
            return back()->with('message', $v->messages()->first());
        }

        $user = auth()->user();
        $point = Point::firstOrCreate(['user_id' => auth()->user()->id]);

        if ($point && $point->use_code) {
            return back()->with('message','this user use invite code before');
        }

        if ($point->invite_code == request('code')) {
            return back()->with('message','you can not use your code.');
        }

        if (points('invite')) {
            return back()->with('message','created successfully');
        }

        return back()->with('message','some thimg wrong');

    }
}
