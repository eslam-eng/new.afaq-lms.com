<?php

namespace Database\Seeders;

use App\Models\LookupType;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class LookupsPermissionSeeder extends Seeder
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
                array_push($permissions,[
                    "title" => "{$lookup_type->slug}_{$permissions_type}",
                ]);
            }
        }

        Permission::insertOrIgnore($permissions);

    }
}
