<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class UserActionObserver
{
    public function created(User $model)
    {
        try {
            $data  = ['action' => 'created', 'model_name' => 'User'];
            $users = \App\Models\User::whereHas('roles', function ($q) {
                return $q->where('title', 'Admin');
            })->get();
            Notification::send($users, new DataChangeEmailNotification($data));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function updated(User $model)
    {
        try {
            $data  = ['action' => 'updated', 'model_name' => 'User'];
            $users = \App\Models\User::whereHas('roles', function ($q) {
                return $q->where('title', 'Admin');
            })->get();
            Notification::send($users, new DataChangeEmailNotification($data));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function deleting(User $model)
    {
        try {
            $data  = ['action' => 'deleted', 'model_name' => 'User'];
            $users = \App\Models\User::whereHas('roles', function ($q) {
                return $q->where('title', 'Admin');
            })->get();
            Notification::send($users, new DataChangeEmailNotification($data));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
