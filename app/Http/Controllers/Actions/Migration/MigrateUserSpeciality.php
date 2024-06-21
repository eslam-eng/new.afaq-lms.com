<?php

namespace App\Http\Controllers\Actions\Migration;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use PDO;

class MigrateUserSpeciality
{
    public function execute()
    {
        $users = User::whereNull('specialty_id')->get();

        foreach ($users as $user) {
            $instructor_data = DB::connection('afaq_source')->table('user')->where('username',$user->email)->first();
            if($instructor_data){
                $user->update([
                    'specialty_id' => $instructor_data->job_title_id,
                    'occupational_classification_number'=> $instructor_data->specialises_number
                ]);
            }
        }

    }
}
