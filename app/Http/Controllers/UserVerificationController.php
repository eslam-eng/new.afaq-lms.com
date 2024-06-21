<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use App\Notifications\VisitorILRegisteration;
use App\Notifications\VisitorEGRegisteration;
use App\Notifications\VisitorWelcomeEmail;
use App\Notifications\SendApprovelEmailNotification;

class UserVerificationController extends Controller
{
    public function approve($token)
    {
        $user = User::where('verification_token', $token)->first();
        abort_if(!$user, 404);

        $user_roles_arr = $user->roles->toArray();
        $user_role = $user_roles_arr[0]['id'];
        $user->approved           = 1;
        $user->verified           = 1;
        $user->verified_at        = Carbon::now()->format(config('panel.date_format') . ' ' . config('panel.time_format'));
        $user->email_verified_at        = Carbon::now()->format(config('panel.date_format') . ' ' . config('panel.time_format'));
        $user->status = 'approved';
        $user->save();
        $log_message = "";
        if ($user_role == 3) {

            $log_message = "The user: " . $user->name . " verified his account and the email has been sent.";
            $this->save_log($user->id, $log_message);

            $users = User::where('id', $user->id)->get();
            try {
                //code...
                Notification::send($users, new VisitorEGRegisteration($user));
            } catch (\Throwable $th) {
                //throw $th;
            }
            return redirect()->route('login')->with('message', trans('global.emailVerificationEG'));
        }
    }
}
