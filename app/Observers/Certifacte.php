<?php

namespace App\Observers;

use App\Models\User;
use App\Models\UserCertificate;
use App\Notifications\CertificateExportingNotification;
use Illuminate\Support\Facades\Notification;

class Certifacte
{
    public function created(UserCertificate $model)
    {
        try {
            $users = User::where('id', $model->user_id)->get();

            // Notification::send($users, new CertificateExportingNotification($model->course));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

}
