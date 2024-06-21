<?php

namespace App\Http\Controllers\Actions\Migration;

use App\DataLoader\Core\Loader;
use App\Http\Controllers\Actions\Migration\MigrateOldData;
use App\Models\Instructor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UsersMigration extends MigrateOldData
{
    public function usersMigrate()
    {
        $user_mapped = [
            'username' => 'user_name',
            'country' => 'birth_country',
            'ID_type' => 'identity_type',
            'ID_number' => 'identity_number',
            'fullname' => 'full_name_ar',
            'fullname' => 'full_name_en',
        ];
        Loader::apply($user_mapped, 'user', 'users');

        return true;
    }

    public function students()
    {
        $users = User::all();
        foreach ($users as $key => $user) {
            if ($user->status) {
                $user->email_verified_at = date('Y-m-d H:i:s');
                $user->approved = 1;
                $user->verified = 1;
                $user->verified_at = date('Y-m-d H:i:s');
                $user->save();
            }

            if($key % 10){
                sleep(1);
            }
        }
    }

    public function instructors()
    {
        $instructor_data = DB::connection('afaq_source')->table('core_assignment')->where('role_id',13)->get();

        foreach ($instructor_data as $inst) {
            $user = User::find($inst->user_id);

            if($user){
                Instructor::insertOrIgnore([
                    'id' => $user->id,
                    'name_ar' => $user->full_name_en,
                    'name_en' => $user->full_name_en,
                    'bio_ar' => $user->full_name_en,
                    'bio_en' => $user->full_name_en,
                    'mobile' => $user->phone,
                    'password' => ''
                ]);
            }
        }
    }
}
