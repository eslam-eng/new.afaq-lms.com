<?php

namespace App\Http\Controllers\Actions\Migration;

use App\Http\Controllers\Actions\Migration\MigrateOldData;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RolesMigration extends MigrateOldData
{
    public function rolesMigrate()
    {
        $users = User::all();
        foreach ($users as $user) {
            if (in_array($user->id, [1, 2, 3])) {
                DB::table('role_user')->updateOrInsert(
                    ['user_id' => $user->id],
                    [
                        'user_id' => $user->id,
                        'role_id' => 1
                    ]
                );
            } else {
                DB::table('role_user')->insert([
                    'user_id' => $user->id,
                    'role_id' => 3
                ]);
            }
        }

        return true;
    }
}
