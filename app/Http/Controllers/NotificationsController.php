<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class NotificationsController extends Controller
{
    public function index(){

        $notifications = auth()->user()->unreadNotifications;

        return view('home' , compact('notifications'));
    }

    public function markNotification(Request $request){
        auth()->user()->unreadNotifications->when($request->input('id') , function ($query) use ($request){
            return $query->where('id',$request->input('id'));
        })->markAsRead();
        return response()->noContent();
    }

    public function markAllAsRead(){
        foreach( auth()->user()->unreadNotifications as $notification ){
            $notification->markAsRead();
        }
        return redirect()->back();
    }

    public function destory($id){
        auth()->user()->unreadNotifications->when($id , function ($query) use ($id){
            return $query->where('id',$id);
        })->delete();
        return redirect()->back();
    }
    


}