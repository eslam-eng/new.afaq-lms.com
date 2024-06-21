<?php

namespace Database\Seeders;

use App\Models\TicketCategory;
use Illuminate\Database\Seeder;

class TicketCategoriesTableSeeder extends Seeder
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

                "title" => "المدفوعات",
                "status" => 1
            ],
            [
                "title" => "التسجيل",
                "status" => 1
            ],
            [
                "title" => "الدعم",
                "status" => 1
            ],
            [
                "title" => "أخرى",
                "status" => 1
            ],
        ];
        TicketCategory::insert($data);
    }
}


