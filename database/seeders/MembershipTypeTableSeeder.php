<?php

namespace Database\Seeders;

use App\Models\MembershipType;
use Illuminate\Database\Seeder;

class MembershipTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [

                "name_en" => "ACTIVE MEMBERSHIP",
                "name_ar" => "عضوية عاملة",
                "status" => 1
            ],
            [
                "name_en" => "AFFILIATE MEMBERSHIP",
                "name_ar" => "عضوية انتساب",
                "status" => 1
            ],
            [
                "name_en" => "STUDENT MEMBERSHIP",
                "name_ar" => "عضوية طالب",
                "status" => 1
            ],
        ];
        MembershipType::insert($data);

    }
}
