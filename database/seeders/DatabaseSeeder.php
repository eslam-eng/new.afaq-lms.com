<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            // UsersTableSeeder::class,
            // RoleUserTableSeeder::class,
            CountriesSeeder::class,
            MembershipTypeTableSeeder::class,
            PaymentMethodTableSeeder::class,
            BankListTableSeeder::class,
            LookupTypesSeeder::class,
            LookupsPermissionSeeder::class,
            LookupsSeeder::class,
            LookupsRolePremissionSeeeder::class
        ]);
    }
}

