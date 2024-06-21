<?php

namespace Database\Seeders;

use App\Models\LookupType;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LookupsRolePremissionSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $permissions_types = ['access','create','edit','delete'];
        $permissions = [];

        $lookup_types = LookupType::get();

        foreach ($lookup_types as $lookup_type) {
            foreach ($permissions_types as $permissions_type) {
                $permission = Permission::where('title', "{$lookup_type->slug}_{$permissions_type}")->first();
                DB::table('permission_role')->insertOrIgnore([
                    'role_id' => 1,
                    'permission_id' => $permission->id
                ]);
            }
        }


    }
}
