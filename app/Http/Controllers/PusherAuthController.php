<?php
     
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;
     
class PusherAuthController extends Controller
{
    public function authenticate(Request $request)
    {

        if (!auth()->check()) {
            abort(403); // Or handle unauthorized access in your desired way
        }    
        // dd('ddd');
        $pusher = new Pusher(
            config('broadcasting.connections.pusher.key'),
            config('broadcasting.connections.pusher.secret'),
            config('broadcasting.connections.pusher.app_id'),
            [
                'cluster' => config('broadcasting.connections.pusher.options.cluster'),
                'encrypted' => config('broadcasting.connections.pusher.options.encrypted'),
            ]
        );

        $socketId = $request->input('socket_id');
        $channelName = $request->input('channel_name');
        $presenceData = [
            'user_id' => auth()->user()->id,
            'user_info' => [
                'name' => auth()->user()->email,
                // Add any additional user information you want to send
            ],
        ];

        
        $auth = $pusher->presence_auth($channelName, $socketId, auth()->user()->id, $presenceData);
        return response()->json($auth);
    }
}